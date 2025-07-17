<?php

namespace Opencart\System\Library;

require_once DIR_EXTENSION . 'paynl/vendor/autoload.php';
require_once DIR_EXTENSION . 'paynl/system/library/Autoload.php';

use Opencart\System\Library\PayConfig;
use PayNL\Sdk\Model\Request\ServiceGetConfigRequest;

class PayPaymentMethods
{
    public $openCart;
    public $payConfig;
    public $code;
    public $route;

    const METHOD_INSTORE = 1729; // phpcs:ignore

    const METHOD_AFTERPAY = 739; // phpcs:ignore
    const METHOD_AFTERPAYINT = 2561; // phpcs:ignore
    const METHOD_BILLER = 2931; // phpcs:ignore
    const METHOD_BILLINK = 1672; // phpcs:ignore
    const METHOD_CAPAYABLE = 1744; // phpcs:ignore
    const METHOD_IN3 = 1813; // phpcs:ignore
    const METHOD_IN3BUSINESS = 3192; // phpcs:ignore
    const METHOD_KLARNA = 1717; // phpcs:ignore
    const METHOD_YEHHPAY = 1877; // phpcs:ignore

    public $showIssuers;
    public $showBusiness;

    /**
     * @param object $openCart
     */
    public function __construct($openCart) // phpcs:ignore
    {
        $this->openCart = $openCart;
        $this->payConfig = new PayConfig($openCart);
        $this->code = $this->payConfig->code;
        $this->route = $this->payConfig->route;

        $this->showIssuers = [
            self::METHOD_INSTORE,
        ];

        $this->showBusiness = [
            self::METHOD_AFTERPAY,
            self::METHOD_AFTERPAYINT,
            self::METHOD_BILLER,
            self::METHOD_BILLINK,
            self::METHOD_CAPAYABLE,
            self::METHOD_IN3,
            self::METHOD_IN3BUSINESS,
            self::METHOD_KLARNA,
            self::METHOD_YEHHPAY,
        ];
    }

    /**
     * @return array
     * @throws Exception
     */
    public function getPaymentOptions()
    {
        $config = $this->payConfig->getConfig();
        $request = new ServiceGetConfigRequest($this->payConfig->getServiceId());
        $request->setConfig($config);
        $service = $request->start();
        $paymentMethodsFromPay = [];
        foreach ($service->getPaymentMethods() as $method) {
            $paymentMethodsFromPay[$method->getId()] = $method;
        }
        return $paymentMethodsFromPay;
    }

    /**
     * @param string $paymentOptionId
     * @return boolean
     */
    public function showIssuersField($paymentOptionId)
    {
        if (in_array($paymentOptionId, $this->showIssuers)) {
            return true;
        }
        return false;
    }

    /**
     * @param string $paymentOptionId
     * @return boolean
     */
    public function showBusinessFields($paymentOptionId)
    {
        if (in_array($paymentOptionId, $this->showBusiness)) {
            return true;
        }
        return false;
    }
}
