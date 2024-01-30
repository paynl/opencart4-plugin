<?php

declare(strict_types=1);

namespace PayNL\Sdk\Model\Request;

use PayNL\Sdk\Exception\PayException;
use PayNL\Sdk\Request\RequestData;
use PayNL\Sdk\Model\TransactionStatusResponse;
use PayNL\Sdk\Request\RequestInterface;

/**
 * Class TransactionStatusRequest
 * Request the status of a transaction using this method.
 *
 * @package PayNL\Sdk\Model\Request
 */
class TransactionStatusRequest extends RequestData
{
    private string $orderId;

    /**
     * @param $orderid
     */
    public function __construct($orderId)
    {
        $this->orderId = $orderId;
        parent::__construct('GetTransactionStatus', '/transactions/%transactionId%/status', RequestInterface::METHOD_GET);
    }

    public function getPathParameters(): array
    {
        return [
          'transactionId' => $this->orderId
        ];
    }

    public function getBodyParameters(): array
    {
        return [];
    }

    /**
     * @return TransactionStatusResponse
     * @throws PayException
     */
    public function start(): TransactionStatusResponse
    {
        $prefix = (string)substr($this->orderId, 0, 2);
        if ($prefix == '51') {
            $this->config->setCore('https://rest.achterelkebetaling.nl');
        } elseif ($prefix == '52') {
            $this->config->setCore('https://rest.payments.nl');
        }
        return parent::start();
    }
}