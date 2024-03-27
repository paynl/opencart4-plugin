<?php

namespace Opencart\Catalog\Controller\Extension\paynl\Payment;

require_once DIR_EXTENSION . 'paynl/vendor/autoload.php';
require_once DIR_EXTENSION . 'paynl/system/library/Autoload.php';

use Opencart\System\Library\PayConfig;
use Opencart\System\Library\PayHelper;
use Opencart\System\Library\PayTransaction;
use PayNL\Sdk\Exception\PayException;

class Exchange extends \Opencart\System\Engine\Controller
{
    private $code;
    private $route;
    private $payConfig;
    private $helper;
    private $payTransaction;

    /**
     * @param \Opencart\System\Engine\Registry $registry
     */
    public function __construct(\Opencart\System\Engine\Registry $registry)
    {
        $this->payConfig = new PayConfig($this);
        $this->helper = new PayHelper($this);
        $this->payTransaction = new PayTransaction($this);
        $this->code = $this->payConfig->code;
        $this->route = $this->payConfig->route;
        parent::__construct($registry);
    }

    /**
     * @return void
     */
    public function exchange()
    {
        $transactionId = $this->request->get['order_id'] ?? null;
        $orderId = $this->request->get['extra1'] ?? null;
        $action = $this->request->get['action'] ?? null;

        if ($action == 'pending') {
            $message = 'ignoring PENDING';
            $this->helper->logDebug('Exchange: ' . $message, ['orderId' => $orderId, 'transactionId' => $transactionId]);
            die("TRUE|" . $message);
        }

        if ($action == 'new_ppt') {
            $processing = $this->payTransaction->checkProcessing($transactionId);
            if (!empty($processing)) {
                die('FALSE| Already Processing payment');
            }
        }

        try {
            $message = $this->payTransaction->processTransaction($transactionId, $orderId, $action);
            $this->helper->logDebug('Exchange: ' . $message, ['orderId' => $orderId, 'transactionId' => $transactionId]);
            if ($action == 'new_ppt') {
                $this->payTransaction->removeProcessing($transactionId);
            }
            die("TRUE|" . $message);
        } catch (PayException $e) {
            $message = "Api error: " . $e->getMessage();
        } catch (\Exception $e) {
            $message = "Unknown error: " . $e->getMessage();
        }

        $this->helper->logNotice('Exchange: ' . $message, ['orderId' => $orderId, 'transactionId' => $transactionId]);
        die("FALSE|" . $message);
    }
}
