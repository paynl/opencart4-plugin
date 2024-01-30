<?php

declare(strict_types=1);

namespace PayNL\Sdk\Model\Request;

use PayNL\Sdk\Exception\PayException;
use PayNL\Sdk\Request\RequestData;
use PayNL\Sdk\Model\Terminals;
use PayNL\Sdk\Request\RequestInterface;

/**
 * Class TerminalBrowseRequest
 * Request the status of a transaction using this method.
 *
 * @package PayNL\Sdk\Model\Request
 */
class TerminalBrowseRequest extends RequestData
{
    public function __construct()
    {
        parent::__construct('TerminalBrowse', '/terminals', RequestInterface::METHOD_GET);
    }

    public function getPathParameters(): array
    {
        return [];
    }

    public function getBodyParameters(): array
    {
        return [];
    }

    /**
     * @return Terminals
     * @throws PayException
     */
    public function start(): Terminals
    {
        return parent::start();
    }
}