<?php

declare(strict_types=1);

use PHPUnit\Framework\Attributes\Depends;
use PHPUnit\Framework\TestCase;
use PayNL\Sdk\Model\Voucher;

/**
 * Class VoucherTest
 */
final class VoucherTest extends TestCase
{
    /**
     * @var Voucher
     */
    protected $objVoucher;

    /**
     * @return void
     */
    public function setUp(): void
    {
        $this->objVoucher = new Voucher();
    }

    /**
     * @param $objVoucher
     * @return void
     */
    #[Depends('testItCanSetPinCode')]
    public function testItCanGetPinCode($objVoucher): void
    {
        $this->assertEquals(method_exists($this->objVoucher, 'getPinCode'), true);
        $this->assertEquals('testPinCode', $objVoucher->getPinCode());
    }

    /**
     * @return Voucher
     */
    public function testItCanSetPinCode(): Voucher
    {
        $this->assertEquals(method_exists($this->objVoucher, 'setPinCode'), true);
        $this->objVoucher->setPinCode('testPinCode');
        return $this->objVoucher;
    }

    /**
     * @param $objVoucher
     * @return void
     */
    #[Depends('testItCanSetPosId')]
    public function testItCanGetPosId($objVoucher): void
    {
        $this->assertEquals(method_exists($this->objVoucher, 'getPosId'), true);
        $this->assertEquals('testPosId', $objVoucher->getPosId());
    }

    /**
     * @return Voucher
     */
    public function testItCanSetPosId(): Voucher
    {
        $this->assertEquals(method_exists($this->objVoucher, 'setPosId'), true);
        $this->objVoucher->setPosId('testPosId');
        return $this->objVoucher;
    }

    /**
     * @param $objVoucher
     * @return void
     */
    public function testItCanGetBalance(): void
    {
        $this->assertEquals(method_exists($this->objVoucher, 'getBalance'), true);
    }


    /**
     * @param $objVoucher
     * @return void
     */
    #[Depends('testItCanSetNumber')]
    public function testItCanGetNumber($objVoucher): void
    {
        $this->assertEquals(method_exists($this->objVoucher, 'getNumber'), true);
        $this->assertEquals('testNumber', $objVoucher->getNumber());
    }

    /**
     * @return Voucher
     */
    public function testItCanSetNumber(): Voucher
    {
        $this->assertEquals(method_exists($this->objVoucher, 'setNumber'), true);
        $this->objVoucher->setNumber('testNumber');
        return $this->objVoucher;
    }

    /**
     * @param $objVoucher
     * @return void
     */
    public function testItCanGetLinks(): void
    {
        $this->assertEquals(method_exists($this->objVoucher, 'getLinks'), true);
    }

    /**
     * @param $objVoucher
     * @return void
     */
    public function testItCanGetAmount(): void
    {
        $this->assertEquals(method_exists($this->objVoucher, 'getAmount'), true);
    }
}