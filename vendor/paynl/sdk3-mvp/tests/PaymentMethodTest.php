<?php

declare(strict_types=1);

use PHPUnit\Framework\Attributes\Depends;
use PHPUnit\Framework\TestCase;
use PayNL\Sdk\Model\PaymentMethod;

/**
 * Class PaymentMethodTest
 */
final class PaymentMethodTest extends TestCase
{
    /**
     * @var PaymentMethod
     */
    protected $objPaymentMethod;

    /**
     * @return void
     */
    public function setUp(): void
    {
        $this->objPaymentMethod = new PaymentMethod();
    }

    /**
     * @param $objPaymentMethod
     * @return void
     */
    #[Depends('testItCanSetName')]
    public function testItCanGetName($objPaymentMethod): void
    {
        $this->assertEquals(method_exists($this->objPaymentMethod, 'getName'), true);
        $this->assertEquals('testName', $objPaymentMethod->getName());
    }

    /**
     * @return PaymentMethod
     */
    public function testItCanSetName(): PaymentMethod
    {
        $this->assertEquals(method_exists($this->objPaymentMethod, 'setName'), true);
        $this->objPaymentMethod->setName('testName');
        return $this->objPaymentMethod;
    }

    /**
     * @param $objPaymentMethod
     * @return void
     */
    #[Depends('testItCanSetDescription')]
    public function testItCanGetDescription($objPaymentMethod): void
    {
        $this->assertEquals(method_exists($this->objPaymentMethod, 'getDescription'), true);
        $this->assertEquals('testDescription', $objPaymentMethod->getDescription());
    }

    /**
     * @return PaymentMethod
     */
    public function testItCanSetDescription(): PaymentMethod
    {
        $this->assertEquals(method_exists($this->objPaymentMethod, 'setDescription'), true);
        $this->objPaymentMethod->setDescription('testDescription');
        return $this->objPaymentMethod;
    }

    /**
     * @param $objPaymentMethod
     * @return void
     */
    public function testItCanGetSequence(): void
    {
        $this->assertEquals(method_exists($this->objPaymentMethod, 'getSequence'), true);
    }


    /**
     * @param $objPaymentMethod
     * @return void
     */
    public function testItCanGetPublic(): void
    {
        $this->assertEquals(method_exists($this->objPaymentMethod, 'getPublic'), true);
    }


    /**
     * @param $objPaymentMethod
     * @return void
     */
    #[Depends('testItCanSetStatus')]
    public function testItCanGetStatus($objPaymentMethod): void
    {
        $this->assertEquals(method_exists($this->objPaymentMethod, 'getStatus'), true);
        $this->assertEquals('testStatus', $objPaymentMethod->getStatus());
    }

    /**
     * @return PaymentMethod
     */
    public function testItCanSetStatus(): PaymentMethod
    {
        $this->assertEquals(method_exists($this->objPaymentMethod, 'setStatus'), true);
        $this->objPaymentMethod->setStatus('testStatus');
        return $this->objPaymentMethod;
    }

    /**
     * @param $objPaymentMethod
     * @return void
     */
    #[Depends('testItCanSetImage')]
    public function testItCanGetImage($objPaymentMethod): void
    {
        $this->assertEquals(method_exists($this->objPaymentMethod, 'getImage'), true);
        $this->assertEquals('testImage', $objPaymentMethod->getImage());
    }

    /**
     * @return PaymentMethod
     */
    public function testItCanSetImage(): PaymentMethod
    {
        $this->assertEquals(method_exists($this->objPaymentMethod, 'setImage'), true);
        $this->objPaymentMethod->setImage('testImage');
        return $this->objPaymentMethod;
    }

    /**
     * @param $objPaymentMethod
     * @return void
     */
    public function testItCanGetTranslations(): void
    {
        $this->assertEquals(method_exists($this->objPaymentMethod, 'getTranslations'), true);
    }


    /**
     * @param $objPaymentMethod
     * @return void
     */
    public function testItCanGetPaymentProfiles(): void
    {
        $this->assertEquals(method_exists($this->objPaymentMethod, 'getPaymentProfiles'), true);
    }


    /**
     * @param $objPaymentMethod
     * @return void
     */
    public function testItCanGetId(): void
    {
        $this->assertEquals(method_exists($this->objPaymentMethod, 'getId'), true);
    }


}