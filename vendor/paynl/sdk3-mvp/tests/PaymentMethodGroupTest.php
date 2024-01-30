<?php

declare(strict_types=1);

use PHPUnit\Framework\Attributes\Depends;
use PHPUnit\Framework\TestCase;
use PayNL\Sdk\Model\PaymentMethodGroup;

/**
 * Class PaymentMethodGroupTest
 */
final class PaymentMethodGroupTest extends TestCase
{
    /**
     * @var PaymentMethodGroup
     */
    protected $objPaymentMethodGroup;

    /**
     * @return void
     */
    public function setUp(): void
    {
        $this->objPaymentMethodGroup = new PaymentMethodGroup();
    }

    /**
     * @param $objPaymentMethodGroup
     * @return void
     */
    public function testItCanGetId(): void
    {
        $this->assertEquals(method_exists($this->objPaymentMethodGroup, 'getId'), true);
    }


    /**
     * @param $objPaymentMethodGroup
     * @return void
     */
    #[Depends('testItCanSetName')]
    public function testItCanGetName($objPaymentMethodGroup): void
    {
        $this->assertEquals(method_exists($this->objPaymentMethodGroup, 'getName'), true);
        $this->assertEquals('testName', $objPaymentMethodGroup->getName());
    }

    /**
     * @return PaymentMethodGroup
     */
    public function testItCanSetName(): PaymentMethodGroup
    {
        $this->assertEquals(method_exists($this->objPaymentMethodGroup, 'setName'), true);
        $this->objPaymentMethodGroup->setName('testName');
        return $this->objPaymentMethodGroup;
    }

    /**
     * @param $objPaymentMethodGroup
     * @return void
     */
    #[Depends('testItCanSetPublicName')]
    public function testItCanGetPublicName($objPaymentMethodGroup): void
    {
        $this->assertEquals(method_exists($this->objPaymentMethodGroup, 'getPublicName'), true);
        $this->assertEquals('testPublicName', $objPaymentMethodGroup->getPublicName());
    }

    /**
     * @return PaymentMethodGroup
     */
    public function testItCanSetPublicName(): PaymentMethodGroup
    {
        $this->assertEquals(method_exists($this->objPaymentMethodGroup, 'setPublicName'), true);
        $this->objPaymentMethodGroup->setPublicName('testPublicName');
        return $this->objPaymentMethodGroup;
    }

    /**
     * @param $objPaymentMethodGroup
     * @return void
     */
    public function testItCanGetSequence(): void
    {
        $this->assertEquals(method_exists($this->objPaymentMethodGroup, 'getSequence'), true);
    }


    /**
     * @param $objPaymentMethodGroup
     * @return void
     */
    public function testItCanGetTranslations(): void
    {
        $this->assertEquals(method_exists($this->objPaymentMethodGroup, 'getTranslations'), true);
    }


    /**
     * @param $objPaymentMethodGroup
     * @return void
     */
    #[Depends('testItCanSetImage')]
    public function testItCanGetImage($objPaymentMethodGroup): void
    {
        $this->assertEquals(method_exists($this->objPaymentMethodGroup, 'getImage'), true);
        $this->assertEquals('testImage', $objPaymentMethodGroup->getImage());
    }

    /**
     * @return PaymentMethodGroup
     */
    public function testItCanSetImage(): PaymentMethodGroup
    {
        $this->assertEquals(method_exists($this->objPaymentMethodGroup, 'setImage'), true);
        $this->objPaymentMethodGroup->setImage('testImage');
        return $this->objPaymentMethodGroup;
    }

    /**
     * @param $objPaymentMethodGroup
     * @return void
     */
    public function testItCanGetRequiredFields(): void
    {
        $this->assertEquals(method_exists($this->objPaymentMethodGroup, 'getRequiredFields'), true);
    }


    /**
     * @param $objPaymentMethodGroup
     * @return void
     */
    #[Depends('testItCanSetCreatedAt')]
    public function testItCanGetCreatedAt($objPaymentMethodGroup): void
    {
        $this->assertEquals(method_exists($this->objPaymentMethodGroup, 'getCreatedAt'), true);
        $this->assertEquals('testCreatedAt', $objPaymentMethodGroup->getCreatedAt());
    }

    /**
     * @return PaymentMethodGroup
     */
    public function testItCanSetCreatedAt(): PaymentMethodGroup
    {
        $this->assertEquals(method_exists($this->objPaymentMethodGroup, 'setCreatedAt'), true);
        $this->objPaymentMethodGroup->setCreatedAt('testCreatedAt');
        return $this->objPaymentMethodGroup;
    }

}