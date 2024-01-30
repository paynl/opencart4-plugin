<?php

namespace Opencart\System\Library;

require_once DIR_EXTENSION . 'paynl/vendor/autoload.php';

use PayNL\Sdk\Config\Config;
use PayNL\Sdk\Model\Request\ServiceGetConfigRequest;

class PayHelper
{
    public $code = 'paynl';
    public $route = 'extension/paynl/payment/paynl';
    public $openCart;

    public function __construct($openCart)
    {
        $this->openCart = $openCart;
    }

    public function getObject()
    {
        $query = $this->openCart->db->query("SELECT * FROM " . DB_PREFIX . "extension_install WHERE code = 'paynl'");
        $payModuleVersion = $query->row['version'] ?? '';
        return 'Pay.: ' . $payModuleVersion . ', Opencart: ' . VERSION . ', PHP:' . phpversion();
    }

    public function getConfig()
    {
        $config = new Config();
        $config->setUsername($this->openCart->config->get('payment_' . $this->code . '_tokencode'));
        $config->setPassword($this->openCart->config->get('payment_' . $this->code . '_apitoken'));
        return $config;
    }

    public function getPaymentOptions()
    {
        $config = $this->getConfig();
        $request = new ServiceGetConfigRequest($this->openCart->config->get('payment_' . $this->code . '_serviceid'));
        $request->setConfig($config);
        $service = $request->start();
        $paymentMethodsFromPay = [];
        foreach ($service->getPaymentMethods() as $method) {
            $paymentMethodsFromPay[$method->getId()] = $method;
        }
        return $paymentMethodsFromPay;
    }
}
