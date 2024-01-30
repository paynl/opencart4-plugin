<?php

declare(strict_types=1);

namespace PayNL\Sdk\Model\Request;

use PayNL\Sdk\Exception\PayException;
use PayNL\Sdk\Request\RequestData;
use PayNL\Sdk\Model\TransactionVoidResponse;
use PayNL\Sdk\Request\RequestInterface;

/**
 * Class TransactionVoidRequest
 *
 * @package PayNL\Sdk\Model\Request
 */
class TransactionVoidRequest extends RequestData
{
    private string $transactionId;

    /**
     * @param $transactionId
     */
    public function __construct($transactionId)
    {
        $this->transactionId = $transactionId;
        parent::__construct('TransactionVoid', '/transactions/%transactionId%/void', RequestInterface::METHOD_PATCH);
    }

    /**
     * @return string[]
     */
    public function getPathParameters(): array
    {
        return ['transactionId' => $this->transactionId];
    }

    /**
     * @return array
     */
    public function getBodyParameters(): array
    {
        return [];
    }

    /**
     * @return TransactionVoidResponse
     * @throws PayException
     */
    public function start(): TransactionVoidResponse
    {
        return parent::start();
    }
}