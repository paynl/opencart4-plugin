<?php

declare(strict_types=1);

use PHPUnit\Framework\Attributes\Depends;
use PHPUnit\Framework\TestCase;
use PayNL\Sdk\Model\CheckoutOption;

/**
 * Class CheckoutOptionTest
 */
final class CheckoutOptionTest extends TestCase
{
    /**
     * @var CheckoutOption
     */
    protected $objCheckoutOption;

    /**
     * @return void
     */
    public function setUp(): void
    {
        $this->objCheckoutOption = new CheckoutOption();
    }

    /**
     * @param $objCheckoutOption
     * @return void
     */
    #[Depends('testItCanSetTag')]
    public function testItCanGetTag($objCheckoutOption): void
    {
        $this->assertEquals(method_exists($this->objCheckoutOption, 'getTag'), true);
        $this->assertEquals('testTag', $objCheckoutOption->getTag());
    }

    /**
     * @return CheckoutOption
     */
    public function testItCanSetTag(): CheckoutOption
    {
        $this->assertEquals(method_exists($this->objCheckoutOption, 'setTag'), true);
        $this->objCheckoutOption->setTag('testTag');
        return $this->objCheckoutOption;
    }

    /**
     * @param $objCheckoutOption
     * @return void
     */
    #[Depends('testItCanSetName')]
    public function testItCanGetName($objCheckoutOption): void
    {
        $this->assertEquals(method_exists($this->objCheckoutOption, 'getName'), true);
        $this->assertEquals('testName', $objCheckoutOption->getName());
    }

    /**
     * @return CheckoutOption
     */
    public function testItCanSetName(): CheckoutOption
    {
        $this->assertEquals(method_exists($this->objCheckoutOption, 'setName'), true);
        $this->objCheckoutOption->setName('testName');
        return $this->objCheckoutOption;
    }

    /**
     * @param $objCheckoutOption
     * @return void
     */
    public function testItCanGetTranslations(): void
    {
        $this->assertEquals(method_exists($this->objCheckoutOption, 'getTranslations'), true);
    }


    /**
     * @param $objCheckoutOption
     * @return void
     */
    #[Depends('testItCanSetImage')]
    public function testItCanGetImage($objCheckoutOption): void
    {
        $this->assertEquals(method_exists($this->objCheckoutOption, 'getImage'), true);
        $this->assertEquals('testImage', $objCheckoutOption->getImage());
    }

    /**
     * @return CheckoutOption
     */
    public function testItCanSetImage(): CheckoutOption
    {
        $this->assertEquals(method_exists($this->objCheckoutOption, 'setImage'), true);
        $this->objCheckoutOption->setImage('testImage');
        return $this->objCheckoutOption;
    }

    /**
     * @param $objCheckoutOption
     * @return void
     */
    public function testItCanGetPaymentMethods(): void
    {
        $this->assertEquals(method_exists($this->objCheckoutOption, 'getPaymentMethods'), true);
    }


    /**
     * @param $objCheckoutOption
     * @return void
     */
    public function testItCanGetRequiredFields(): void
    {
        $this->assertEquals(method_exists($this->objCheckoutOption, 'getRequiredFields'), true);
    }


}