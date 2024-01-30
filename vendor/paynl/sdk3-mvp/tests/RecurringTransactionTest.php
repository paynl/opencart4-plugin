<?php

declare(strict_types=1);

use PHPUnit\Framework\Attributes\Depends;
use PHPUnit\Framework\TestCase;
use PayNL\Sdk\Model\RecurringTransaction;

/**
 * Class RecurringTransactionTest
 */
final class RecurringTransactionTest extends TestCase
{
    /**
     * @var RecurringTransaction
     */
    protected $objRecurringTransaction;

    /**
     * @return void
     */
    public function setUp(): void
    {
        $this->objRecurringTransaction = new RecurringTransaction();
    }

    /**
     * @param $objRecurringTransaction
     * @return void
     */
    #[Depends('testItCanSetDescription')]
    public function testItCanGetDescription($objRecurringTransaction): void
    {
        $this->assertEquals(method_exists($this->objRecurringTransaction, 'getDescription'), true);
        $this->assertEquals('testDescription', $objRecurringTransaction->getDescription());
    }

    /**
     * @return RecurringTransaction
     */
    public function testItCanSetDescription(): RecurringTransaction
    {
        $this->assertEquals(method_exists($this->objRecurringTransaction, 'setDescription'), true);
        $this->objRecurringTransaction->setDescription('testDescription');
        return $this->objRecurringTransaction;
    }

    /**
     * @param $objRecurringTransaction
     * @return void
     */
    #[Depends('testItCanSetExtra1')]
    public function testItCanGetExtra1($objRecurringTransaction): void
    {
        $this->assertEquals(method_exists($this->objRecurringTransaction, 'getExtra1'), true);
        $this->assertEquals('testExtra1', $objRecurringTransaction->getExtra1());
    }

    /**
     * @return RecurringTransaction
     */
    public function testItCanSetExtra1(): RecurringTransaction
    {
        $this->assertEquals(method_exists($this->objRecurringTransaction, 'setExtra1'), true);
        $this->objRecurringTransaction->setExtra1('testExtra1');
        return $this->objRecurringTransaction;
    }

    /**
     * @param $objRecurringTransaction
     * @return void
     */
    #[Depends('testItCanSetExtra2')]
    public function testItCanGetExtra2($objRecurringTransaction): void
    {
        $this->assertEquals(method_exists($this->objRecurringTransaction, 'getExtra2'), true);
        $this->assertEquals('testExtra2', $objRecurringTransaction->getExtra2());
    }

    /**
     * @return RecurringTransaction
     */
    public function testItCanSetExtra2(): RecurringTransaction
    {
        $this->assertEquals(method_exists($this->objRecurringTransaction, 'setExtra2'), true);
        $this->objRecurringTransaction->setExtra2('testExtra2');
        return $this->objRecurringTransaction;
    }

    /**
     * @param $objRecurringTransaction
     * @return void
     */
    #[Depends('testItCanSetExtra3')]
    public function testItCanGetExtra3($objRecurringTransaction): void
    {
        $this->assertEquals(method_exists($this->objRecurringTransaction, 'getExtra3'), true);
        $this->assertEquals('testExtra3', $objRecurringTransaction->getExtra3());
    }

    /**
     * @return RecurringTransaction
     */
    public function testItCanSetExtra3(): RecurringTransaction
    {
        $this->assertEquals(method_exists($this->objRecurringTransaction, 'setExtra3'), true);
        $this->objRecurringTransaction->setExtra3('testExtra3');
        return $this->objRecurringTransaction;
    }

    /**
     * @param $objRecurringTransaction
     * @return void
     */
    public function testItCanGetAmount(): void
    {
        $this->assertEquals(method_exists($this->objRecurringTransaction, 'getAmount'), true);
    }


}