<?php

declare(strict_types=1);

use PHPUnit\Framework\Attributes\Depends;
use PHPUnit\Framework\TestCase;
use PayNL\Sdk\Model\Refund;

/**
 * Class RefundTest
 */
final class RefundTest extends TestCase
{
    /**
     * @var Refund
     */
    protected $objRefund;

    /**
     * @return void
     */
    public function setUp(): void
    {
        $this->objRefund = new Refund();
    }

    /**
     * @param $objRefund
     * @return void
     */
    #[Depends('testItCanSetId')]
    public function testItCanGetId($objRefund): void
    {
        $this->assertEquals(method_exists($this->objRefund, 'getId'), true);
        $this->assertEquals('testId', $objRefund->getId());
    }

    /**
     * @return Refund
     */
    public function testItCanSetId(): Refund
    {
        $this->assertEquals(method_exists($this->objRefund, 'setId'), true);
        $this->objRefund->setId('testId');
        return $this->objRefund;
    }

    /**
     * @param $objRefund
     * @return void
     */
    #[Depends('testItCanSetPaymentSessionId')]
    public function testItCanGetPaymentSessionId($objRefund): void
    {
        $this->assertEquals(method_exists($this->objRefund, 'getPaymentSessionId'), true);
        $this->assertEquals('testPaymentSessionId', $objRefund->getPaymentSessionId());
    }

    /**
     * @return Refund
     */
    public function testItCanSetPaymentSessionId(): Refund
    {
        $this->assertEquals(method_exists($this->objRefund, 'setPaymentSessionId'), true);
        $this->objRefund->setPaymentSessionId('testPaymentSessionId');
        return $this->objRefund;
    }

    /**
     * @param $objRefund
     * @return void
     */
    #[Depends('testItCanSetDescription')]
    public function testItCanGetDescription($objRefund): void
    {
        $this->assertEquals(method_exists($this->objRefund, 'getDescription'), true);
        $this->assertEquals('testDescription', $objRefund->getDescription());
    }

    /**
     * @return Refund
     */
    public function testItCanSetDescription(): Refund
    {
        $this->assertEquals(method_exists($this->objRefund, 'setDescription'), true);
        $this->objRefund->setDescription('testDescription');
        return $this->objRefund;
    }

    /**
     * @param $objRefund
     * @return void
     */
    public function testItCanGetProducts(): void
    {
        $this->assertEquals(method_exists($this->objRefund, 'getProducts'), true);
    }


    /**
     * @param $objRefund
     * @return void
     */
    #[Depends('testItCanSetReason')]
    public function testItCanGetReason($objRefund): void
    {
        $this->assertEquals(method_exists($this->objRefund, 'getReason'), true);
        $this->assertEquals('testReason', $objRefund->getReason());
    }

    /**
     * @return Refund
     */
    public function testItCanSetReason(): Refund
    {
        $this->assertEquals(method_exists($this->objRefund, 'setReason'), true);
        $this->objRefund->setReason('testReason');
        return $this->objRefund;
    }

    /**
     * @param $objRefund
     * @return void
     */
    public function testItCanGetProcessDate(): void
    {
        $this->assertEquals(method_exists($this->objRefund, 'getProcessDate'), true);
    }


    /**
     * @param $objRefund
     * @return void
     */
    public function testItCanGetLinks(): void
    {
        $this->assertEquals(method_exists($this->objRefund, 'getLinks'), true);
    }


    /**
     * @param $objRefund
     * @return void
     */
    public function testItCanGetAmount(): void
    {
        $this->assertEquals(method_exists($this->objRefund, 'getAmount'), true);
    }


    /**
     * @param $objRefund
     * @return void
     */
    public function testItCanGetBankAccount(): void
    {
        $this->assertEquals(method_exists($this->objRefund, 'getBankAccount'), true);
    }


    /**
     * @param $objRefund
     * @return void
     */
    public function testItCanGetStatus(): void
    {
        $this->assertEquals(method_exists($this->objRefund, 'getStatus'), true);
    }


}