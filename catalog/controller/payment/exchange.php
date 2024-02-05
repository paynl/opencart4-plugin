<?php

namespace Opencart\Catalog\Controller\Extension\paynl\Payment;

require_once DIR_EXTENSION . 'paynl/vendor/autoload.php';
require_once DIR_EXTENSION . 'paynl/system/library/Autoload.php';

use Opencart\System\Library\PayHelper;
use Opencart\System\Library\PayTransaction;
use PayNL\Sdk\Exception\PayException;

class Exchange extends \Opencart\System\Engine\Controller
{
    private $code;
    private $route;
    private $helper;
    private $payTransaction;

    /**
     * @param \Opencart\System\Engine\Registry $registry
     */
    public function __construct(\Opencart\System\Engine\Registry $registry)
    {
        $this->helper = new PayHelper($this);
        $this->payTransaction = new PayTransaction($this);
        $this->code = $this->helper->code;
        $this->route = $this->helper->route;
        parent::__construct($registry);
    }

    /**
     * @return void
     */
    public function exchange()
    {
        $transactionId = $_REQUEST['order_id'] ?? null;
        $orderId = $_REQUEST['extra1'] ?? null;
        $action = $_REQUEST['action'] ?? null;       

        if ($action == 'pending') {
            $message = 'ignoring PENDING';
            $this->helper->log('Exchange: ' . $message, ['orderId' => $orderId, 'transactionId' => $transactionId]);
            die("TRUE|" . $message);
        }

        try {
            $message = $this->payTransaction->processTransaction($transactionId, $orderId);
            $this->helper->log('Exchange: ' . $message, ['orderId' => $orderId, 'transactionId' => $transactionId]);
            die("TRUE|" . $message);
        } catch (PayException $e) {
            $message = "Api error: " . $e->getMessage();
        } catch (\Exception $e) {
            $message = "Unknown error: " . $e->getMessage();
        }

        $this->helper->log('Exchange: ' . $message, ['orderId' => $orderId, 'transactionId' => $transactionId]);
        die("FALSE|" . $message);
    }
}
