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

    const LOG_ALL = 0;
    const LOG_CRITICAL_NOTICE = 1;
    const LOG_ONLY_CRITICAL = 2;
    const LOG_NONE = 3;

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
            $this->logNotice('Credentials: validation failed', ['error' => $e->getMessage()]);
            return false;
        }
        return true;
    }

    /**
     * @param string $message
     * @param array $data
     * @return void
     */
    public function logCritical(string $message = '', array $data = [])
    {
        if ($this->payConfig->getLoggingLevel() <= self::LOG_ONLY_CRITICAL) {
            $this->writeLog('[CRITICAL] ' . $message, $data);
        }
    }

    /**
     * @param string $message
     * @param array $data
     * @return void
     */
    public function logNotice(string $message = '', array $data = [])
    {
        if ($this->payConfig->getLoggingLevel() <= self::LOG_CRITICAL_NOTICE) {
            $this->writeLog('[NOTICE] ' . $message, $data);
        }
    }

    /**
     * @param string $message
     * @param array $data
     * @return void
     */
    public function logInfo(string $message = '', array $data = [])
    {
        if ($this->payConfig->getLoggingLevel() <= self::LOG_CRITICAL_NOTICE) {
            $this->writeLog('[INFO] ' . $message, $data);
        }
    }

    /**
     * @param string $message
     * @param array $data
     * @return void
     */
    public function logDebug(string $message = '', array $data = [])
    {
        if ($this->payConfig->getLoggingLevel() <= self::LOG_CRITICAL_NOTICE) {
            $this->writeLog('[DEBUG] ' . $message, $data);
        }
    }

    /**
     * @param string $message
     * @param array $data
     * @return void
     */
    public function writeLog(string $message = '', array $data = [])
    {
        if (!empty($data)) {
            foreach ($data as $key => $dataText) {
                if (is_array($dataText)) {
                    $dataText = print_r($dataText, true);
                }
                $message .= ', ' . $key . ': ' . $dataText;
            }
        }
        $log = new Log($this->code . '.log');
        $log->write($message);
    }
}
