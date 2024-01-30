<?php

declare(strict_types=1);

use PHPUnit\Framework\Attributes\Depends;
use PHPUnit\Framework\TestCase;
use PayNL\Sdk\Model\Merchant;

/**
 * Class MerchantTest
 */
final class MerchantTest extends TestCase
{
    /**
     * @var Merchant
     */
    protected $objMerchant;

    /**
     * @return void
     */
    public function setUp(): void
    {
        $this->objMerchant = new Merchant();
    }

    /**
     * @param $objMerchant
     * @return void
     */
    #[Depends('testItCanSetName')]
    public function testItCanGetName($objMerchant): void
    {
        $this->assertEquals(method_exists($this->objMerchant, 'getName'), true);
        $this->assertEquals('testName', $objMerchant->getName());
    }

    /**
     * @return Merchant
     */
    public function testItCanSetName(): Merchant
    {
        $this->assertEquals(method_exists($this->objMerchant, 'setName'), true);
        $this->objMerchant->setName('testName');
        return $this->objMerchant;
    }

    /**
     * @param $objMerchant
     * @return void
     */
    #[Depends('testItCanSetCoc')]
    public function testItCanGetCoc($objMerchant): void
    {
        $this->assertEquals(method_exists($this->objMerchant, 'getCoc'), true);
        $this->assertEquals('testCoc', $objMerchant->getCoc());
    }

    /**
     * @return Merchant
     */
    public function testItCanSetCoc(): Merchant
    {
        $this->assertEquals(method_exists($this->objMerchant, 'setCoc'), true);
        $this->objMerchant->setCoc('testCoc');
        return $this->objMerchant;
    }

    /**
     * @param $objMerchant
     * @return void
     */
    #[Depends('testItCanSetVat')]
    public function testItCanGetVat($objMerchant): void
    {
        $this->assertEquals(method_exists($this->objMerchant, 'getVat'), true);
        $this->assertEquals('testVat', $objMerchant->getVat());
    }

    /**
     * @return Merchant
     */
    public function testItCanSetVat(): Merchant
    {
        $this->assertEquals(method_exists($this->objMerchant, 'setVat'), true);
        $this->objMerchant->setVat('testVat');
        return $this->objMerchant;
    }

    /**
     * @param $objMerchant
     * @return void
     */
    #[Depends('testItCanSetWebsite')]
    public function testItCanGetWebsite($objMerchant): void
    {
        $this->assertEquals(method_exists($this->objMerchant, 'getWebsite'), true);
        $this->assertEquals('testWebsite', $objMerchant->getWebsite());
    }

    /**
     * @return Merchant
     */
    public function testItCanSetWebsite(): Merchant
    {
        $this->assertEquals(method_exists($this->objMerchant, 'setWebsite'), true);
        $this->objMerchant->setWebsite('testWebsite');
        return $this->objMerchant;
    }

    /**
     * @param $objMerchant
     * @return void
     */
    public function testItCanGetPostalAddress(): void
    {
        $this->assertEquals(method_exists($this->objMerchant, 'getPostalAddress'), true);
    }


    /**
     * @param $objMerchant
     * @return void
     */
    public function testItCanGetVisitAddress(): void
    {
        $this->assertEquals(method_exists($this->objMerchant, 'getVisitAddress'), true);
    }


    /**
     * @param $objMerchant
     * @return void
     */
    public function testItCanGetTrademarks(): void
    {
        $this->assertEquals(method_exists($this->objMerchant, 'getTrademarks'), true);
    }


    /**
     * @param $objMerchant
     * @return void
     */
    public function testItCanGetContactMethods(): void
    {
        $this->assertEquals(method_exists($this->objMerchant, 'getContactMethods'), true);
    }


    /**
     * @param $objMerchant
     * @return void
     */
    #[Depends('testItCanSetCode')]
    public function testItCanGetCode($objMerchant): void
    {
        $this->assertEquals(method_exists($this->objMerchant, 'getCode'), true);
        $this->assertEquals('testCode', $objMerchant->getCode());
    }

    /**
     * @return Merchant
     */
    public function testItCanSetCode(): Merchant
    {
        $this->assertEquals(method_exists($this->objMerchant, 'setCode'), true);
        $this->objMerchant->setCode('testCode');
        return $this->objMerchant;
    }

    /**
     * @param $objMerchant
     * @return void
     */
    #[Depends('testItCanSetPublicName')]
    public function testItCanGetPublicName($objMerchant): void
    {
        $this->assertEquals(method_exists($this->objMerchant, 'getPublicName'), true);
        $this->assertEquals('testPublicName', $objMerchant->getPublicName());
    }

    /**
     * @return Merchant
     */
    public function testItCanSetPublicName(): Merchant
    {
        $this->assertEquals(method_exists($this->objMerchant, 'setPublicName'), true);
        $this->objMerchant->setPublicName('testPublicName');
        return $this->objMerchant;
    }

    /**
     * @param $objMerchant
     * @return void
     */
    public function testItCanGetLinks(): void
    {
        $this->assertEquals(method_exists($this->objMerchant, 'getLinks'), true);
    }


    /**
     * @param $objMerchant
     * @return void
     */
    public function testItCanGetBankAccount(): void
    {
        $this->assertEquals(method_exists($this->objMerchant, 'getBankAccount'), true);
    }


    /**
     * @param $objMerchant
     * @return void
     */
    #[Depends('testItCanSetCreatedAt')]
    public function testItCanGetCreatedAt($objMerchant): void
    {
        $this->assertEquals(method_exists($this->objMerchant, 'getCreatedAt'), true);
        $this->assertEquals('testCreatedAt', $objMerchant->getCreatedAt());
    }

    /**
     * @return Merchant
     */
    public function testItCanSetCreatedAt(): Merchant
    {
        $this->assertEquals(method_exists($this->objMerchant, 'setCreatedAt'), true);
        $this->objMerchant->setCreatedAt('testCreatedAt');
        return $this->objMerchant;
    }

}