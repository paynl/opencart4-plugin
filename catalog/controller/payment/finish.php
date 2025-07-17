<?php

namespace Opencart\Catalog\Controller\Extension\paynl\Payment;

require_once DIR_EXTENSION . 'paynl/vendor/autoload.php';
require_once DIR_EXTENSION . 'paynl/system/library/Autoload.php';

use Opencart\System\Library\PayConfig;
use Opencart\System\Library\PayTransaction;
use PayNL\Sdk\Model\Pay\PayStatus;

class Finish extends \Opencart\System\Engine\Controller
{
    private $code;
    private $route;
    private $payConfig;
    private $payTransaction;
    const ORDERSTATUS_DENIED = -64;

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
        $payOrderId = $this->request->get['id'];
        $orderStatusId = (new PayStatus())->get($this->request->get['statusCode']);

        if ($orderStatusId == PayStatus::PENDING || $orderStatusId == PayStatus::PAID || $orderStatusId == PayStatus::AUTHORIZE || $orderStatusId == PayStatus::VERIFY) {
            $this->response->redirect($this->url->link('checkout/success'));
        } elseif ($this->request->get['statusCode'] == self::ORDERSTATUS_DENIED) {
            $this->response->redirect($this->url->link('extension/paynl/checkout/denied'));
        } else {
            $this->response->redirect($this->url->link('checkout/checkout'));
        }
        die();
    }
}
