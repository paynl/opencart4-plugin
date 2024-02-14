<?php

namespace Opencart\System\Library;

require_once DIR_EXTENSION . 'paynl/vendor/autoload.php';
require_once DIR_EXTENSION . 'paynl/system/library/Autoload.php';

use PayNL\Sdk\Config\Config;
use PayNL\Sdk\Model\Request\ServiceGetConfigRequest;
use \Opencart\System\Library\Log;

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

        $object_string = 'opencart 4 ';
        $object_string .= $jsonData['version'] ?? '-';
        $object_string .= ' | ';
        $object_string .= VERSION ?? '-';
        $object_string .= ' | ';
        $object_string .= substr(phpversion(), 0, 3);

        return $object_string;
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
            $request->start();
        } catch (\Exception $e) {
            $this->log('Credentials: validation failed', ['error' => $e->getMessage()]);
            return false;
        }
        return true;
    }

    /**
     * @param string $message
     * @param array $data
     * @return void
     */
    public function log(string $message = '', array $data = [])
    {
        $logging_enabled = $this->openCart->config->get('payment_' . $this->code . '_logging') ?? 1;
        if ($logging_enabled !== '0') {
            if (!empty($data)) {
                foreach ($data as $key => $dataText) {
                    $message .= ', ' . $key . ': ' . $dataText;
                }
            }
            $log = new Log($this->code . '.log');
            $log->write($message);
        }
    }
}
