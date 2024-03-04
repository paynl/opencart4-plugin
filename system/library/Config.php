<?php

namespace Opencart\System\Library;

require_once DIR_EXTENSION . 'paynl/vendor/autoload.php';
require_once DIR_EXTENSION . 'paynl/system/library/Autoload.php';

use PayNL\Sdk\Config\Config;

class PayConfig
{
    public $code = 'paynl';
    public $route = 'extension/paynl/payment/paynl';
    public $openCart;

    /**
     * @param object $openCart
     */
    public function __construct($openCart) // phpcs:ignore

    {
        $this->openCart = $openCart;
    }

    /**
     * @return Config
     * @throws Exception
     */
    public function getConfig()
    {
        $config = new Config();
        $config->setUsername($this->getTokencode());
        $config->setPassword($this->getApiToken());
        return $config;
    }

    /**
     * @return boolean
     */
    public function isTestMode()
    {
        return ($this->openCart->config->get('payment_' . $this->code . '_testmode') == 1);
    }

    /**
     * @return string
     */
    public function getApiToken()
    {
        return $this->openCart->config->get('payment_' . $this->code . '_apitoken');
    }

    /**
     * @return string
     */
    public function getTokencode()
    {
        return $this->openCart->config->get('payment_' . $this->code . '_tokencode');
    }

    /**
     * @return string
     */
    public function getServiceId()
    {
        return $this->openCart->config->get('payment_' . $this->code . '_serviceid');
    }

    /**
     * @return boolean
     */
    public function getLoggingLevel()
    {
        return ($this->openCart->config->get('payment_' . $this->code . '_logging') ?? 0);
    }

    /**
     * @return string
     */
    public function getScreenLanguage()
    {
        return $this->openCart->config->get('payment_' . $this->code . '_screen_language');
    }

    /**
     * @return string
     */
    public function shouldFollowPayment()
    {
        return ($this->openCart->config->get('payment_' . $this->code . '_follow_payment') == 1);
    }

    /**
     * @return string
     */
    public function getObject()
    {
        $json = file_get_contents(DIR_EXTENSION . 'paynl/install.json');
        $jsonData = json_decode($json, true);

        $object_string = 'opencart 4 ';
        $object_string .= $jsonData['version'] ?? '-';
        $object_string .= ' | ';
        $object_string .= VERSION ?? '-';
        $object_string .= ' | ';
        $object_string .= substr(phpversion(), 0, 3);

        return $object_string;
    }
}
