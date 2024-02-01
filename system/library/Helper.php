<?php

namespace Opencart\System\Library;

require_once DIR_EXTENSION . 'paynl/vendor/autoload.php';
require_once DIR_EXTENSION . 'paynl/system/library/Autoload.php';

use PayNL\Sdk\Config\Config;
use PayNL\Sdk\Model\Request\ServiceGetConfigRequest;

class PayHelper
{
    public $code = 'paynl';
    public $route = 'extension/paynl/payment/paynl';
    public $openCart;

    /**
     * @param object $openCart
     */
    public function __construct($openCart)
    {
        $this->openCart = $openCart;
    }

    /**
     * @return string
     */
    public function getObject()
    {
        $json = file_get_contents(DIR_EXTENSION . 'paynl/install.json');
        $jsonData = json_decode($json, true);
        $payModuleVersion = $jsonData['version'] ?? '';
        return 'Pay.: ' . $payModuleVersion . ', Opencart: ' . VERSION . ', PHP:' . phpversion();
    }

    /**
     * @return Config
     * @throws Exception
     */
    public function getConfig()
    {
        $config = new Config();
        $config->setUsername($this->openCart->config->get('payment_' . $this->code . '_tokencode'));
        $config->setPassword($this->openCart->config->get('payment_' . $this->code . '_apitoken'));
        return $config;
    }

    /**
     * @return array
     * @throws Exception
     */
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

    /**
     * @return boolean
     */
    public function validateCredentials($tokencode, $apitoken, $serviceid)
    {
        try {
            $config = new Config();
            $config->setUsername($tokencode);
            $config->setPassword($apitoken);
            $request = new ServiceGetConfigRequest($serviceid);
            $request->setConfig($config);
            $service = $request->start();
        } catch (\Exception $e) {
            return false;
        }
        return true;
    }
}
