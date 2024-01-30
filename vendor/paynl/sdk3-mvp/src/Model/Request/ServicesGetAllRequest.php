<?php

declare(strict_types=1);

namespace PayNL\Sdk\Model\Request;

use PayNL\Sdk\Exception\PayException;
use PayNL\Sdk\Request\RequestData;
use PayNL\Sdk\Model\ServicesGetAllResponse;
use PayNL\Sdk\Request\RequestInterface;

/**
 * Class ServicesGetAllRequest
 * Return a list of all services linked to the current merchant
 *
 * @package PayNL\Sdk\Model\Request
 */
class ServicesGetAllRequest extends RequestData
{

    public function __construct()
    {
        parent::__construct('ServicesGetAll', '/services', RequestInterface::METHOD_GET);
    }

    /**
     * @return array
     */
    public function getPathParameters(): array
    {
        return [];
    }

    /**
     * @return array
     */
    public function getBodyParameters(): array
    {
        return [];
    }

    /**
     * @return ServicesGetAllResponse
     * @throws PayException
     */
    public function start(): ServicesGetAllResponse
    {
        return parent::start();
    }
}