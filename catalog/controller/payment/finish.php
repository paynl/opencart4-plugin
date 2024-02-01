<?php

namespace Opencart\Catalog\Controller\Extension\paynl\Payment;

require_once DIR_EXTENSION . 'paynl/vendor/autoload.php';
require_once DIR_EXTENSION . 'paynl/system/library/Autoload.php';

use Opencart\System\Library\PayHelper;
use Opencart\System\Library\PayTransaction;

class Finish extends \Opencart\System\Engine\Controller
{
    private string $code;
    private string $route;
    private PayHelper $helper;
    private PayTransaction $payTransaction;

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
    public function finish()
    {
        $this->load->language($this->helper->route);
        $payOrderId = $this->request->get['orderId'];

        try {
            $transaction = $this->payTransaction->getTransactionStatus($payOrderId);
        } catch (\Exception $e) {
            header("Location: " . $this->url->link('checkout/failure'));
            die();
        }

        if ($transaction->isPending() || $transaction->isPaid() || $transaction->isAuthorized() || $transaction->isBeingVerified()) {
            header("Location: " . $this->url->link('checkout/success'));
        } else {
            header("Location: " . $this->url->link('checkout/checkout'));
        }
        die();
    }
}
