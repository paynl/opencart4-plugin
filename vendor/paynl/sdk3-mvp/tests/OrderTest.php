<?php

declare(strict_types=1);

use PHPUnit\Framework\Attributes\Depends;
use PHPUnit\Framework\TestCase;
use PayNL\Sdk\Model\Order;

/**
 * Class OrderTest
 */
final class OrderTest extends TestCase
{
    /**
     * @var Order
     */
    protected $objOrder;

    /**
     * @return void
     */
    public function setUp(): void
    {
        $this->objOrder = new Order();
    }

    /**
     * @param $objOrder
     * @return void
     */
    #[Depends('testItCanSetCountryCode')]
    public function testItCanGetCountryCode($objOrder): void
    {
        $this->assertEquals(method_exists($this->objOrder, 'getCountryCode'), true);
        $this->assertEquals('testCountryCode', $objOrder->getCountryCode());
    }

    /**
     * @return Order
     */
    public function testItCanSetCountryCode(): Order
    {
        $this->assertEquals(method_exists($this->objOrder, 'setCountryCode'), true);
        $this->objOrder->setCountryCode('testCountryCode');
        return $this->objOrder;
    }

    /**
     * @param $objOrder
     * @return void
     */
    #[Depends('testItCanSetDeliveryDate')]
    public function testItCanGetDeliveryDate($objOrder): void
    {
        $this->assertEquals(method_exists($this->objOrder, 'getDeliveryDate'), true);
        $this->assertEquals('testDeliveryDate', $objOrder->getDeliveryDate());
    }

    /**
     * @return Order
     */
    public function testItCanSetDeliveryDate(): Order
    {
        $this->assertEquals(method_exists($this->objOrder, 'setDeliveryDate'), true);
        $this->objOrder->setDeliveryDate('testDeliveryDate');
        return $this->objOrder;
    }

    /**
     * @param $objOrder
     * @return void
     */
    #[Depends('testItCanSetInvoiceDate')]
    public function testItCanGetInvoiceDate($objOrder): void
    {
        $this->assertEquals(method_exists($this->objOrder, 'getInvoiceDate'), true);
        $this->assertEquals('testInvoiceDate', $objOrder->getInvoiceDate());
    }

    /**
     * @return Order
     */
    public function testItCanSetInvoiceDate(): Order
    {
        $this->assertEquals(method_exists($this->objOrder, 'setInvoiceDate'), true);
        $this->objOrder->setInvoiceDate('testInvoiceDate');
        return $this->objOrder;
    }

    /**
     * @param $objOrder
     * @return void
     */
    public function testItCanGetCustomer(): void
    {
        $this->assertEquals(method_exists($this->objOrder, 'getCustomer'), true);
    }


    /**
     * @param $objOrder
     * @return void
     */
    public function testItCanGetDeliveryAddress(): void
    {
        $this->assertEquals(method_exists($this->objOrder, 'getDeliveryAddress'), true);
    }


    /**
     * @param $objOrder
     * @return void
     */
    public function testItCanGetInvoiceAddress(): void
    {
        $this->assertEquals(method_exists($this->objOrder, 'getInvoiceAddress'), true);
    }


    /**
     * @param $objOrder
     * @return void
     */
    public function testItCanGetProducts(): void
    {
        $this->assertEquals(method_exists($this->objOrder, 'getProducts'), true);
    }


}