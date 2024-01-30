<?php

declare(strict_types=1);

use PHPUnit\Framework\Attributes\Depends;
use PHPUnit\Framework\TestCase;
use PayNL\Sdk\Model\Issuer;

/**
 * Class IssuerTest
 */
final class IssuerTest extends TestCase
{
    /**
     * @var Issuer
     */
    protected $objIssuer;

    /**
     * @return void
     */
    public function setUp(): void
    {
        $this->objIssuer = new Issuer();
    }

    /**
     * @param $objIssuer
     * @return void
     */
    #[Depends('testItCanSetCode')]
    public function testItCanGetCode($objIssuer): void
    {
        $this->assertEquals(method_exists($this->objIssuer, 'getCode'), true);
        $this->assertEquals('testCode', $objIssuer->getCode());
    }

    /**
     * @return Issuer
     */
    public function testItCanSetCode(): Issuer
    {
        $this->assertEquals(method_exists($this->objIssuer, 'setCode'), true);
        $this->objIssuer->setCode('testCode');
        return $this->objIssuer;
    }

    /**
     * @param $objIssuer
     * @return void
     */
    #[Depends('testItCanSetName')]
    public function testItCanGetName($objIssuer): void
    {
        $this->assertEquals(method_exists($this->objIssuer, 'getName'), true);
        $this->assertEquals('testName', $objIssuer->getName());
    }

    /**
     * @return Issuer
     */
    public function testItCanSetName(): Issuer
    {
        $this->assertEquals(method_exists($this->objIssuer, 'setName'), true);
        $this->objIssuer->setName('testName');
        return $this->objIssuer;
    }

    /**
     * @param $objIssuer
     * @return void
     */
    #[Depends('testItCanSetBic')]
    public function testItCanGetBic($objIssuer): void
    {
        $this->assertEquals(method_exists($this->objIssuer, 'getBic'), true);
        $this->assertEquals('testBic', $objIssuer->getBic());
    }

    /**
     * @return Issuer
     */
    public function testItCanSetBic(): Issuer
    {
        $this->assertEquals(method_exists($this->objIssuer, 'setBic'), true);
        $this->objIssuer->setBic('testBic');
        return $this->objIssuer;
    }

    /**
     * @param $objIssuer
     * @return void
     */
    #[Depends('testItCanSetIssuerId')]
    public function testItCanGetIssuerId($objIssuer): void
    {
        $this->assertEquals(method_exists($this->objIssuer, 'getIssuerId'), true);
        $this->assertEquals('testIssuerId', $objIssuer->getIssuerId());
    }

    /**
     * @return Issuer
     */
    public function testItCanSetIssuerId(): Issuer
    {
        $this->assertEquals(method_exists($this->objIssuer, 'setIssuerId'), true);
        $this->objIssuer->setIssuerId('testIssuerId');
        return $this->objIssuer;
    }

    /**
     * @param $objIssuer
     * @return void
     */
    #[Depends('testItCanSetStatus')]
    public function testItCanGetStatus($objIssuer): void
    {
        $this->assertEquals(method_exists($this->objIssuer, 'getStatus'), true);
        $this->assertEquals('testStatus', $objIssuer->getStatus());
    }

    /**
     * @return Issuer
     */
    public function testItCanSetStatus(): Issuer
    {
        $this->assertEquals(method_exists($this->objIssuer, 'setStatus'), true);
        $this->objIssuer->setStatus('testStatus');
        return $this->objIssuer;
    }

    /**
     * @param $objIssuer
     * @return void
     */
    #[Depends('testItCanSetImage')]
    public function testItCanGetImage($objIssuer): void
    {
        $this->assertEquals(method_exists($this->objIssuer, 'getImage'), true);
        $this->assertEquals('testImage', $objIssuer->getImage());
    }

    /**
     * @return Issuer
     */
    public function testItCanSetImage(): Issuer
    {
        $this->assertEquals(method_exists($this->objIssuer, 'setImage'), true);
        $this->objIssuer->setImage('testImage');
        return $this->objIssuer;
    }

    /**
     * @param $objIssuer
     * @return void
     */
    public function testItCanGetPaymentMethod(): void
    {
        $this->assertEquals(method_exists($this->objIssuer, 'getPaymentMethod'), true);
    }


    /**
     * @param $objIssuer
     * @return void
     */
    public function testItCanGetLinks(): void
    {
        $this->assertEquals(method_exists($this->objIssuer, 'getLinks'), true);
    }


    /**
     * @param $objIssuer
     * @return void
     */
    public function testItCanGetBankAccount(): void
    {
        $this->assertEquals(method_exists($this->objIssuer, 'getBankAccount'), true);
    }


    /**
     * @param $objIssuer
     * @return void
     */
    #[Depends('testItCanSetCreatedAt')]
    public function testItCanGetCreatedAt($objIssuer): void
    {
        $this->assertEquals(method_exists($this->objIssuer, 'getCreatedAt'), true);
        $this->assertEquals('testCreatedAt', $objIssuer->getCreatedAt());
    }

    /**
     * @return Issuer
     */
    public function testItCanSetCreatedAt(): Issuer
    {
        $this->assertEquals(method_exists($this->objIssuer, 'setCreatedAt'), true);
        $this->objIssuer->setCreatedAt('testCreatedAt');
        return $this->objIssuer;
    }

}