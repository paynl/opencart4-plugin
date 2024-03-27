<?php

namespace Opencart\System\Library;

require_once DIR_EXTENSION . 'paynl/vendor/autoload.php';
require_once DIR_EXTENSION . 'paynl/system/library/Autoload.php';

use PayNL\Sdk\Config\Config;
use PayNL\Sdk\Model\Request\ServiceGetConfigRequest;

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
     * @param boolean $useCore
     * @return Config
     * @throws Exception
     */
    public function getConfig($useCore = false)
    {
        $config = new Config();
        $config->setUsername($this->getTokencode());
        $config->setPassword($this->getApiToken());

        $core = $this->getCore();
        if (!empty($core) && $useCore === true) {
            $config->setCore($core);
        }

        return $config;
    }

    /**
     * @return boolean
     */
    public function isTestMode()
    {
        $ip = $_SERVER["REMOTE_ADDR"];
        $ipconfig = $this->openCart->config->get('payment_' . $this->code . '_test_ip_address');

        if (!empty($ipconfig)) {
            $allowed_ips = explode(',', $ipconfig);
            if (
                in_array($ip, $allowed_ips) &&
                filter_var($ip, FILTER_VALIDATE_IP) &&
                strlen($ip) > 0 &&
                count($allowed_ips) > 0
            ) {
                return true;
            }
        }

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
     * @return string
     */
    public function getCore()
    {
        $core = $this->openCart->config->get('payment_' . $this->code . '_failover_gateway');
        if ($core == 'custom') {
            return $this->openCart->config->get('payment_' . $this->code . '_custom_gateway');
        } elseif (!empty($core)) {
            return 'https://rest.' . $core;
        }
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
    public function getOrderDescription()
    {   
        $description = $this->openCart->config->get('payment_' . $this->code . '_order_description');
        return (!empty($description)) ? $description . ' ' : 'Order ';
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
    public function getCustomExchangeURL()
    {
        return trim($this->openCart->config->get('payment_' . $this->code . '_custom_exchange_url'));
    }    

    /**
     * @return string
     */
    public function shouldFollowPayment()
    {
        return ($this->openCart->config->get('payment_' . $this->code . '_follow_payment') == 1);
    }

    /**
     * @return string||null
     */
    public function getVersion()
    {
        $json = file_get_contents(DIR_EXTENSION . 'paynl/install.json');
        $jsonData = json_decode($json, true);

        $version = $jsonData['version'] ?? null;
        return $version;
    }

    /**
     * @return string
     */
    public function getObject()
    {
        $object_string = 'opencart 4 ';
        $object_string .= $this->getVersion() ?? '-';
        $object_string .= ' | ';
        $object_string .= VERSION ?? '-';
        $object_string .= ' | ';
        $object_string .= substr(phpversion(), 0, 3);

        return $object_string;
    }

    /**
     * @return array
     */
    public function getTguList()
    {
        $config = (new ServiceGetConfigRequest($this->getServiceId()))->setConfig($this->getConfig())->start();
        return $config->getTguList() ?? [];
    }
}
