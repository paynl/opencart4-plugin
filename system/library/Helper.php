<?php

namespace Opencart\System\Library;

require_once DIR_EXTENSION . 'paynl/vendor/autoload.php';
require_once DIR_EXTENSION . 'paynl/system/library/Autoload.php';

use Opencart\System\Library\Log;
use Opencart\System\Library\PayConfig;
use PayNL\Sdk\Config\Config;
use PayNL\Sdk\Model\Request\ServiceGetConfigRequest;

class PayHelper
{
    public $openCart;
    public $payConfig;
    public $code;
    public $route;

    /**
     * @param object $openCart
     */
    public function __construct($openCart) // phpcs:ignore
    {
        $this->openCart = $openCart;
        $this->payConfig = new PayConfig($openCart);
        $this->code = $this->payConfig->code;
        $this->route = $this->payConfig->route;
    }
 
    /**
     * @param string $tokencode
     * @param string $apitoken
     * @param string $serviceid
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
        $logging_enabled = $this->payConfig->isLoggingEnabled();
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
