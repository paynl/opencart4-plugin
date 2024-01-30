<?php

declare(strict_types=1);

namespace PayNL\Sdk\Model\Request;

use PayNL\Sdk\Exception\PayException;
use PayNL\Sdk\Request\RequestData;
use PayNL\Sdk\Model\Terminal;
use PayNL\Sdk\Request\RequestInterface;

/**
 * Class TerminalGetRequest
 * Request the status of a transaction using this method.
 *
 * @package PayNL\Sdk\Model\Request
 */
class TerminalGetRequest extends RequestData
{
    private string $terminalCode;

    /**
     * @param $terminalCode
     */
    public function __construct($terminalCode)
    {
        $this->terminalCode = $terminalCode;
        parent::__construct('TerminalGet', '/terminals/%terminalCode%', RequestInterface::METHOD_GET);
    }

    public function getPathParameters(): array
    {
        return [
          'terminalCode' => $this->terminalCode
        ];
    }

    public function getBodyParameters(): array
    {
        return [];
    }

    /**
     * @return Terminal
     * @throws PayException
     */
    public function start(): Terminal
    {
        return parent::start();
    }
}