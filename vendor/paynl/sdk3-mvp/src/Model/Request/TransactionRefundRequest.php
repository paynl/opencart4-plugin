<?php

declare(strict_types=1);

namespace PayNL\Sdk\Model\Request;

use PayNL\Sdk\Exception\PayException;
use PayNL\Sdk\Request\RequestData;
use PayNL\Sdk\Model\TransactionRefundResponse;
use PayNL\Sdk\Request\RequestInterface;

/**
 * Class TransactionRefundRequest
 * Refund for a transaction (or partial). Both EX-####-####-#### code or Pay.'s order ID may be used for order identification.
 *
 * @package PayNL\Sdk\Model\Request
 */
class TransactionRefundRequest extends RequestData
{
    private string $transactionId;
    private string $description;
    private string $processDate;
    private float $vatPercentage;
    private string $exchangeUrl;
    private array $products = [];
    private int $amount;
    private string $currency = 'EUR';

    /**
     * @param $transactionId Pay's orderid. Use EX-####-####-#### or Pay's orderID.
     * @param float|null $amount
     * @param string $currency
     */
    public function __construct($transactionId, float $amount = null, string $currency = '')
    {
        $this->transactionId = $transactionId;
        if (!empty($amount)) {
            $this->setAmount($amount);
        }
        if (!empty($currency)) {
            $this->setCurrency($currency);
        }
        parent::__construct('TransactionRefund', '/transactions/%transactionId%/refund', RequestInterface::METHOD_PATCH);
    }

    /**
     * @param $productId
     * @param $quantity
     * @return void
     */
    public function addProduct($productId, $quantity)
    {
        $this->products[$productId] = $quantity;
    }

    /**
     * @return string[]
     */
    public function getPathParameters(): array
    {
        return [
          'transactionId' => $this->transactionId
        ];
    }

    /**
     * @return array
     */
    public function getBodyParameters(): array
    {
        $parameters = [];
        if (!empty($this->amount)) {
            $parameters['amount'] = [
                'value' => $this->amount,
                'currency' => $this->currency
            ];
        }
        foreach ($this->products as $k => $v) {
            $parameters['products'][$k] = $v;
        }
        if (!empty($this->description)) {
            $parameters['description'] = $this->description;
        }
        if (!empty($this->processDate)) {
            $parameters['processDate'] = $this->processDate;
        }
        if (!empty($this->vatPercentage)) {
            $parameters['vatPercentage'] = $this->vatPercentage;
        }
        if (!empty($this->exchangeUrl)) {
            $parameters['exchangeUrl'] = $this->exchangeUrl;
        }
        return $parameters;
    }

    /**
     * @param float $amount
     */
    public function setAmount(float $amount): self
    {
        $this->amount = (int)round($amount * 100);
        return $this;
    }

    /**
     * @param string $currency
     */
    public function setCurrency(string $currency): self
    {
        $this->currency = $currency;
        return $this;
    }

    /**
     * @param string $description
     */
    public function setDescription(string $description): self
    {
        $this->description = $description;
        return $this;
    }

    /**
     * The ISO date at which this entity will be processed
     *
     * @param string $processDate
     */
    public function setProcessDate(string $processDate): self
    {
        if (!(bool)strtotime($processDate)) {
            throw new Exception('not a valid date');
        }

        $this->processDate = $processDate;
        return $this;
    }

    /**
     * The vat percentage this refund applies to.
     * Only applicable for amount, not products, and only for AfterPay.
     *
     * @param float $vatPercentage
     */
    public function setVatPercentage(float $vatPercentage): self
    {
        $this->vatPercentage = $vatPercentage;
        return $this;
    }

    /**
     * @param string $exchangeUrl
     * @return $this
     * @throws Exception
     */
    public function setExchangeUrl(string $exchangeUrl): self
    {
        if (!filter_var($exchangeUrl, FILTER_VALIDATE_URL)) {
            throw new Exception('Not a valid URL');
        }
        $this->exchangeUrl = $exchangeUrl;
        return $this;
    }

    /**
     * @return TransactionRefundResponse
     * @throws PayException
     */
    public function start(): TransactionRefundResponse
    {
        return parent::start();
    }
}