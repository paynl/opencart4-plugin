<?php

namespace Opencart\Catalog\Controller\Extension\paynl\Payment;

require_once DIR_EXTENSION . 'paynl/vendor/autoload.php';
require_once DIR_EXTENSION . 'paynl/system/library/Autoload.php';

use Opencart\System\Library\PayConfig;
use Opencart\System\Library\PayTransaction;

class Finish extends \Opencart\System\Engine\Controller
{
    private $code;
    private $route;
    private $payConfig;
    private $payTransaction;

    public $ORDERSTATUS_PAID = 100;
    public $ORDERSTATUS_AUTHORIZED = array(95, 97);
    public $ORDERSTATUS_PENDING = array(20, 25, 40, 50, 90);
    public $ORDERSTATUS_DENIED = -63;
    public $ORDERSTATUS_CANCELED = -90;
    public $ORDERSTATUS_VERIFY = 85;

    /**
     * @param \Opencart\System\Engine\Registry $registry
     */
    public function __construct(\Opencart\System\Engine\Registry $registry)
    {
        $this->payConfig = new PayConfig($this);
        $this->payTransaction = new PayTransaction($this);
        $this->code = $this->payConfig->code;
        $this->route = $this->payConfig->route;
        parent::__construct($registry);
    }

    /**
     * @return void
     */
    public function finish()
    {
        $this->load->language($this->route);
        $payOrderId = $this->request->get['orderId'];
        $orderStatusId = $this->request->get['orderStatusId'];

        if (in_array($orderStatusId, $this->ORDERSTATUS_PENDING) || $orderStatusId == $this->ORDERSTATUS_PAID || in_array($orderStatusId, $this->ORDERSTATUS_AUTHORIZED) || $orderStatusId == $this->ORDERSTATUS_VERIFY) {
            header("Location: " . $this->url->link('checkout/success'));
        } elseif ($orderStatusId == $this->ORDERSTATUS_DENIED) {
            header("Location: " . $this->url->link('extension/paynl/checkout/denied'));
        } else {
            header("Location: " . $this->url->link('checkout/checkout'));
        }
        die();
    }
}
