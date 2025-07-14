<?php

namespace Opencart\Catalog\Controller\Extension\paynl\Payment;

require_once DIR_EXTENSION . 'paynl/vendor/autoload.php';
require_once DIR_EXTENSION . 'paynl/system/library/Autoload.php';

use Opencart\System\Library\PayConfig;
use Opencart\System\Library\PayHelper;
use Opencart\System\Library\PayTransaction;
use PayNL\Sdk\Exception\PayException;
use PayNL\Sdk\Util\Exchange as PayExchange;

class Exchange extends \Opencart\System\Engine\Controller
{
    private $code;
    private $route;
    private $payConfig;
    private $helper;
    private $payTransaction;

    /**
     * @param \Opencart\System\Engine\Registry $registry
     */
    public function __construct(\Opencart\System\Engine\Registry $registry)
    {
        $this->payConfig = new PayConfig($this);
        $this->helper = new PayHelper($this);
        $this->payTransaction = new PayTransaction($this);
        $this->code = $this->payConfig->code;
        $this->route = $this->payConfig->route;
        parent::__construct($registry);
    }

    /**
     * @return void
     */
    public function exchange()
    {
        $exchange = new PayExchange();
        $transactionId = $exchange->getPayOrderId();
        try {
            # Process the exchange request
            $payOrder = $exchange->process($this->payConfig->getConfig(true));
            if ($payOrder->isPaid() || $payOrder->isAuthorized() || $payOrder->isRefunded() || $payOrder->isCancelled() || $payOrder->isVoided()) {
                if ($payOrder->isPaid() || $payOrder->isAuthorized()) {
                    $processing = $this->payTransaction->checkProcessing($transactionId);
                    if (!empty($processing)) {
                        die('FALSE| Already Processing payment');
                    }  
                }
                $responseMessage = $this->payTransaction->processTransaction($exchange->getPayOrderId(), $payOrder, $exchange->getAction());
                $this->helper->logDebug('Exchange: ' . $responseMessage, ['orderId' => $payOrder->getReference(), 'transactionId' => $exchange->getPayOrderId()]);
                $responseResult = true;
                $this->payTransaction->removeProcessing($transactionId);
            } elseif ($payOrder->isPending()) {
                $responseMessage = 'ignoring PENDING';
                $this->helper->logDebug('Exchange: ' . $responseMessage, ['orderId' => $payOrder->getReference(), 'transactionId' => $exchange->getPayOrderId()]);
                $responseResult = true;
            } else {
                $responseResult = true;
                $responseMessage = 'ignoring ' . $payOrder->getStatusCode(); 
            }        
            
            $this->helper->logDebug('Exchange: ' . $responseMessage, ['orderId' => $payOrder->getReference(), 'transactionId' => $exchange->getPayOrderId()]);
        } catch (\Throwable $exception) {
            $responseResult = false;
            $responseMessage = $exception->getMessage();
        }

        $exchange->setResponse($responseResult, $responseMessage);
    }
}
