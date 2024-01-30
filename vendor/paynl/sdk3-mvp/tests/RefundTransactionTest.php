<?php

declare(strict_types=1);

use PHPUnit\Framework\Attributes\Depends;
use PHPUnit\Framework\TestCase;
use PayNL\Sdk\Model\RefundTransaction;

/**
 * Class RefundTransactionTest
 */
final class RefundTransactionTest extends TestCase
{
    /**
     * @var RefundTransaction
     */
    protected $objRefundTransaction;

    /**
     * @return void
     */
    public function setUp(): void
    {
        $this->objRefundTransaction = new RefundTransaction();
    }

    /**
     * @param $objRefundTransaction
     * @return void
     */
    public function testItCanGetAmountRefunded(): void
    {
        $this->assertEquals(method_exists($this->objRefundTransaction, 'getAmountRefunded'), true);
    }


    /**
     * @param $objRefundTransaction
     * @return void
     */
    public function testItCanGetRefund(): void
    {
        $this->assertEquals(method_exists($this->objRefundTransaction, 'getRefund'), true);
    }


    /**
     * @param $objRefundTransaction
     * @return void
     */
    public function testItCanGetVoucher(): void
    {
        $this->assertEquals(method_exists($this->objRefundTransaction, 'getVoucher'), true);
    }


    /**
     * @param $objRefundTransaction
     * @return void
     */
    public function testItCanGetAmount(): void
    {
        $this->assertEquals(method_exists($this->objRefundTransaction, 'getAmount'), true);
    }


}