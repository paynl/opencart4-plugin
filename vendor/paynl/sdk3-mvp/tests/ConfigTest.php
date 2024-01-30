<?php

declare(strict_types=1);

use PHPUnit\Framework\Attributes\Depends;
use PHPUnit\Framework\TestCase;
use PayNL\Sdk\Model\Config;

/**
 * Class ConfigTest
 */
final class ConfigTest extends TestCase
{
    /**
     * @var Config
     */
    protected $objConfig;

    /**
     * @return void
     */
    public function setUp(): void
    {
        $this->objConfig = new Config();
    }

    /**
     * @param $objConfig
     * @return void
     */
    #[Depends('testItCanSetCode')]
    public function testItCanGetCode($objConfig): void
    {
        $this->assertEquals(method_exists($this->objConfig, 'getCode'), true);
        $this->assertEquals('testCode', $objConfig->getCode());
    }

    /**
     * @return Config
     */
    public function testItCanSetCode(): Config
    {
        $this->assertEquals(method_exists($this->objConfig, 'setCode'), true);
        $this->objConfig->setCode('testCode');
        return $this->objConfig;
    }

    /**
     * @param $objConfig
     * @return void
     */
    #[Depends('testItCanSetName')]
    public function testItCanGetName($objConfig): void
    {
        $this->assertEquals(method_exists($this->objConfig, 'getName'), true);
        $this->assertEquals('testName', $objConfig->getName());
    }

    /**
     * @return Config
     */
    public function testItCanSetName(): Config
    {
        $this->assertEquals(method_exists($this->objConfig, 'setName'), true);
        $this->objConfig->setName('testName');
        return $this->objConfig;
    }


    /**
     * @param $objConfig
     * @return void
     */
    #[Depends('testItCanSetSecret')]
    public function testItCanGetSecret($objConfig): void
    {
        $this->assertEquals(method_exists($this->objConfig, 'getSecret'), true);
        $this->assertEquals('testSecret', $objConfig->getSecret());
    }

    /**
     * @return Config
     */
    public function testItCanSetSecret(): Config
    {
        $this->assertEquals(method_exists($this->objConfig, 'setSecret'), true);
        $this->objConfig->setSecret('testSecret');
        return $this->objConfig;
    }

    /**
     * @param $objConfig
     * @return void
     */
    public function testItCanGetTranslations(): void
    {
        $this->assertEquals(method_exists($this->objConfig, 'getTranslations'), true);
    }


    /**
     * @param $objConfig
     * @return void
     */
    #[Depends('testItCanSetStatus')]
    public function testItCanGetStatus($objConfig): void
    {
        $this->assertEquals(method_exists($this->objConfig, 'getStatus'), true);
        $this->assertEquals('testStatus', $objConfig->getStatus());
    }

    /**
     * @return Config
     */
    public function testItCanSetStatus(): Config
    {
        $this->assertEquals(method_exists($this->objConfig, 'setStatus'), true);
        $this->objConfig->setStatus('testStatus');
        return $this->objConfig;
    }

    /**
     * @param $objConfig
     * @return void
     */
    public function testItCanGetMerchant(): void
    {
        $this->assertEquals(method_exists($this->objConfig, 'getMerchant'), true);
    }


    /**
     * @param $objConfig
     * @return void
     */
    public function testItCanGetTestMode(): void
    {
        $this->assertEquals(method_exists($this->objConfig, 'getTestMode'), true);
    }

    /**
     * @param $objConfig
     * @return void
     */
    public function testItCanGetCheckoutSequence(): void
    {
        $this->assertEquals(method_exists($this->objConfig, 'getCheckoutSequence'), true);
    }


    /**
     * @param $objConfig
     * @return void
     */
    public function testItCanGetCheckoutOptions(): void
    {
        $this->assertEquals(method_exists($this->objConfig, 'getCheckoutOptions'), true);
    }


    /**
     * @param $objConfig
     * @return void
     */
    public function testItCanGetLayout(): void
    {
        $this->assertEquals(method_exists($this->objConfig, 'getLayout'), true);
    }


    /**
     * @param $objConfig
     * @return void
     */
    public function testItCanGetTurnoverGroup(): void
    {
        $this->assertEquals(method_exists($this->objConfig, 'getTurnoverGroup'), true);
    }


    /**
     * @param $objConfig
     * @return void
     */
    public function testItCanGetCategory(): void
    {
        $this->assertEquals(method_exists($this->objConfig, 'getCategory'), true);
    }


    /**
     * @param $objConfig
     * @return void
     */
    public function testItCanGetTguList(): void
    {
        $this->assertEquals(method_exists($this->objConfig, 'getTguList'), true);
    }


    /**
     * @param $objConfig
     * @return void
     */
    public function testItCanGetLinks(): void
    {
        $this->assertEquals(method_exists($this->objConfig, 'getLinks'), true);
    }


    /**
     * @param $objConfig
     * @return void
     */
    #[Depends('testItCanSetCreatedAt')]
    public function testItCanGetCreatedAt($objConfig): void
    {
        $this->assertEquals(method_exists($this->objConfig, 'getCreatedAt'), true);
        $this->assertEquals('testCreatedAt', $objConfig->getCreatedAt());
    }

    /**
     * @return Config
     */
    public function testItCanSetCreatedAt(): Config
    {
        $this->assertEquals(method_exists($this->objConfig, 'setCreatedAt'), true);
        $this->objConfig->setCreatedAt('testCreatedAt');
        return $this->objConfig;
    }

}