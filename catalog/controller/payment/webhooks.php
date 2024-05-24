<?php

namespace Opencart\Catalog\Controller\Extension\paynl\Payment;

require_once DIR_EXTENSION . 'paynl/vendor/autoload.php';
require_once DIR_EXTENSION . 'paynl/system/library/Autoload.php';

use Opencart\System\Library\PayConfig;
use Opencart\System\Library\PayHelper;
use Opencart\System\Library\PayTransaction;

class Webhooks extends \Opencart\System\Engine\Controller
{
    private $code;
    private $route;
    private $payConfig;
    private $helper;
    private $payTransaction;

    public $STATUS_SHIPPED = 3;
    public $STATUS_COMPLETE = 5;
    public $STATUS_CANCELED = 7;

    /**
     * @param \Opencart\System\Engine\Registry $registry
     */
    public function __construct(\Opencart\System\Engine\Registry $registry)
    {
        $this->payConfig = new PayConfig($this);
        $this->payTransaction = new PayTransaction($this);
        $this->helper = new PayHelper($this);
        $this->code = $this->payConfig->code;
        $this->route = $this->payConfig->route;
        parent::__construct($registry);
    }

    public function onOrderStatusChange(&$route, &$data)
    {
        $this->load->model('checkout/order');
        $order_info = $this->model_checkout_order->getOrder((int) $this->request->get['order_id']);
        $current_order_status = $order_info['order_status_id'] ?? null;
        if (
            !(($current_order_status == $this->STATUS_SHIPPED || $current_order_status == $this->STATUS_COMPLETE) && $this->payConfig->autoCaptureEnabled()) &&
            !($current_order_status == $this->STATUS_CANCELED && $this->payConfig->autoVoidEnabled())
        ) {
            return;
        }

        $transaction = $this->payTransaction->getTransaction($this->request->get['order_id']);
        if ($transaction) {
            $dbTransaction = $transaction['db'];
            $payTransaction = $transaction['status'];
            if ($payTransaction->isAuthorized()) {
                try {
                    if ($current_order_status == $this->STATUS_SHIPPED && $this->payConfig->autoCaptureEnabled()) {
                        $this->helper->logDebug('Performing Auto Capture', ['orderId' => $this->request->get['order_id'], 'transactionId' => $dbTransaction['transaction_id']]);
                        $this->payTransaction->capture($dbTransaction['transaction_id'], $dbTransaction['amount']);
                    } elseif ($current_order_status == $this->STATUS_CANCELED && $this->payConfig->autoVoidEnabled()) {
                        $this->helper->logDebug('Performing Auto Void', ['orderId' => $this->request->get['order_id'], 'transactionId' => $dbTransaction['transaction_id']]);
                        $this->payTransaction->void($dbTransaction['transaction_id']);
                    }
                } catch (\Exception $e) {
                    $this->helper->logCritical('Auto Capture|Void Failed: ' . $e->getMessage(), ['orderId' => $this->request->get['order_id'], 'transactionId' => $dbTransaction['transaction_id']]);
                }
            }
        }
    }
}
