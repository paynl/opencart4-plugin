<?php

declare(strict_types=1);

use PHPUnit\Framework\Attributes\Depends;
use PHPUnit\Framework\TestCase;
use PayNL\Sdk\Model\ConfigProvider;

/**
 * Class ConfigProviderTest
 */
final class ConfigProviderTest extends TestCase
{
    /**
     * @var ConfigProvider
     */
    protected $objConfigProvider;

    /**
     * @return void
     */
    public function setUp(): void
    {
        $this->objConfigProvider = new ConfigProvider();
    }

    /**
     * @param $objConfigProvider
     * @return void
     */
    public function testItCanGetDependencyConfig(): void
    {
        $this->assertEquals(method_exists($this->objConfigProvider, 'getDependencyConfig'), true);
    }

    /**
     * @param $objConfigProvider
     * @return void
     */
    public function testItCanGetModelConfig(): void
    {
        $this->assertEquals(method_exists($this->objConfigProvider, 'getModelConfig'), true);
    }

}