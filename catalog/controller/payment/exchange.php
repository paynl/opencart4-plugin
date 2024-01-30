<?php

namespace Opencart\Catalog\Controller\Extension\paynl\Payment;

require_once DIR_EXTENSION . 'paynl/vendor/autoload.php';
require_once DIR_EXTENSION . 'paynl/system/library/Helper.php';

use Opencart\System\Library\PayHelper;
use PayNL\Sdk\Exception\PayException;
use PayNL\Sdk\Model\Request\TransactionStatusRequest;

class Exchange extends \Opencart\System\Engine\Controller
{
    public $STATUS_PENDING = 1;
    public $STATUS_PROCESSING = 2;
    public $STATUS_COMPLETE = 5;
    public $STATUS_CANCELED = 7;
    public $STATUS_DENIED = 8;
    public $STATUS_REFUNDED = 11;
    public $STATUS_VOIDED = 16;

    private string $code;
    private string $route;
    private PayHelper $helper;

    /**
     * @param \Opencart\System\Engine\Registry $registry
     */
    public function __construct(\Opencart\System\Engine\Registry $registry)
    {
        $this->helper = new PayHelper($this);
        $this->code = $this->helper->code;
        $this->route = $this->helper->route;
        parent::__construct($registry);
    }

    /**
     * @return void
     */
    public function exchange()
    {
        $transactionId = isset($_REQUEST['order_id']) ? $_REQUEST['order_id'] : null;
        $orderId = isset($_REQUEST['extra1']) ? $_REQUEST['extra1'] : null;
        $action = isset($_REQUEST['action']) ? $_REQUEST['action'] : null;

        if ($action == 'pending') {
            $message = 'ignoring PENDING';
            die("TRUE|" . $message);
        }

        try {
            $message = $this->processTransaction($transactionId, $orderId);
            die("TRUE|" . $message);
        } catch (PayException $e) {
            $message = "Api error: " . $e->getMessage();
        } catch (Exception $e) {
            $message = "Unknown error: " . $e->getMessage();
        }

        die("FALSE|" . $message);
    }

    /**
     * @param string $transactionId
     * @param string $orderId
     * @return void
     */
    public function processTransaction($transactionId, $orderId)
    {
        $this->load->model('checkout/order');
        $this->load->model('extension/paynl/payment/paynl');

        $transactionStatusRequest = new TransactionStatusRequest($transactionId);
        $transactionStatusRequest->setConfig($this->helper->getConfig());
        $transaction = $transactionStatusRequest->start();

        $iOrderState = null;
        if ($transaction->isPaid() || $transaction->isAuthorized()) {
            $iOrderState = $this->STATUS_PROCESSING;
            $status = 'Processing';
        }
        if ($transaction->isCancelled()) {
            $iOrderState = $this->STATUS_CANCELED;
            $status = 'Cancelled';
        }
        if ($transaction->isRefunded(false)) {
            $iOrderState = $this->STATUS_REFUNDED;
            $status = 'Refunded';
        }

        $order_info = $this->model_checkout_order->getOrder($orderId);
        $current_order_status = $order_info['order_status_id'];

        if ($current_order_status == $iOrderState || !$iOrderState || ($current_order_status == $this->STATUS_PROCESSING && $iOrderState == $this->STATUS_CANCELED)) {
            return 'Ignoring';
        }

        $message = "Status updated to $status";
        $this->model_checkout_order->addHistory($orderId, (int) $iOrderState, $message, false);

        return $message;
    }
}
