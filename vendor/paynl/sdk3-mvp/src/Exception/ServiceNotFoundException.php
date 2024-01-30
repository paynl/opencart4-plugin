<?php

declare(strict_types=1);

namespace PayNL\Sdk\Exception;

use PayNL\Sdk\Packages\Psr\Container\NotFoundExceptionInterface;

/**
 * Class ServiceNotFoundException
 *
 * @package PayNL\Sdk\Exception
 */
class ServiceNotFoundException extends InvalidArgumentException implements NotFoundExceptionInterface
{
}
