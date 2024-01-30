<?php

declare(strict_types=1);

use PHPUnit\Framework\Attributes\Depends;
use PHPUnit\Framework\TestCase;
use PayNL\Sdk\Model\TerminalTransaction;

/**
 * Class TerminalTransactionTest
 */
final class TerminalTransactionTest extends TestCase
{
    /**
     * @var TerminalTransaction
     */
    protected $objTerminalTransaction;

    /**
     * @return void
     */
    public function setUp(): void
    {
        $this->objTerminalTransaction = new TerminalTransaction();
    }

    /**
     * @param $objTerminalTransaction
     * @return void
     */
    #[Depends('testItCanSetState')]
    public function testItCanGetState($objTerminalTransaction): void
    {
        $this->assertEquals(method_exists($this->objTerminalTransaction, 'getState'), true);
        $this->assertEquals('testState', $objTerminalTransaction->getState());
    }

    /**
     * @return TerminalTransaction
     */
    public function testItCanSetState(): TerminalTransaction
    {
        $this->assertEquals(method_exists($this->objTerminalTransaction, 'setState'), true);
        $this->objTerminalTransaction->setState('testState');
        return $this->objTerminalTransaction;
    }

    /**
     * @param $objTerminalTransaction
     * @return void
     */
    #[Depends('testItCanSetTerminalTransactionId')]
    public function testItCanGetTerminalTransactionId($objTerminalTransaction): void
    {
        $this->assertEquals(method_exists($this->objTerminalTransaction, 'getTerminalTransactionId'), true);
        $this->assertEquals('testTerminalTransactionId', $objTerminalTransaction->getTerminalTransactionId());
    }

    /**
     * @return TerminalTransaction
     */
    public function testItCanSetTerminalTransactionId(): TerminalTransaction
    {
        $this->assertEquals(method_exists($this->objTerminalTransaction, 'setTerminalTransactionId'), true);
        $this->objTerminalTransaction->setTerminalTransactionId('testTerminalTransactionId');
        return $this->objTerminalTransaction;
    }

    /**
     * @param $objTerminalTransaction
     * @return void
     */
    #[Depends('testItCanSetTransactionHash')]
    public function testItCanGetTransactionHash($objTerminalTransaction): void
    {
        $this->assertEquals(method_exists($this->objTerminalTransaction, 'getTransactionHash'), true);
        $this->assertEquals('testTransactionHash', $objTerminalTransaction->getTransactionHash());
    }

    /**
     * @return TerminalTransaction
     */
    public function testItCanSetTransactionHash(): TerminalTransaction
    {
        $this->assertEquals(method_exists($this->objTerminalTransaction, 'setTransactionHash'), true);
        $this->objTerminalTransaction->setTransactionHash('testTransactionHash');
        return $this->objTerminalTransaction;
    }

    /**
     * @param $objTerminalTransaction
     * @return void
     */
    #[Depends('testItCanSetIssuerUrl')]
    public function testItCanGetIssuerUrl($objTerminalTransaction): void
    {
        $this->assertEquals(method_exists($this->objTerminalTransaction, 'getIssuerUrl'), true);
        $this->assertEquals('testIssuerUrl', $objTerminalTransaction->getIssuerUrl());
    }

    /**
     * @return TerminalTransaction
     */
    public function testItCanSetIssuerUrl(): TerminalTransaction
    {
        $this->assertEquals(method_exists($this->objTerminalTransaction, 'setIssuerUrl'), true);
        $this->objTerminalTransaction->setIssuerUrl('testIssuerUrl');
        return $this->objTerminalTransaction;
    }

    /**
     * @param $objTerminalTransaction
     * @return void
     */
    #[Depends('testItCanSetStatusUrl')]
    public function testItCanGetStatusUrl($objTerminalTransaction): void
    {
        $this->assertEquals(method_exists($this->objTerminalTransaction, 'getStatusUrl'), true);
        $this->assertEquals('testStatusUrl', $objTerminalTransaction->getStatusUrl());
    }

    /**
     * @return TerminalTransaction
     */
    public function testItCanSetStatusUrl(): TerminalTransaction
    {
        $this->assertEquals(method_exists($this->objTerminalTransaction, 'setStatusUrl'), true);
        $this->objTerminalTransaction->setStatusUrl('testStatusUrl');
        return $this->objTerminalTransaction;
    }

    /**
     * @param $objTerminalTransaction
     * @return void
     */
    #[Depends('testItCanSetCancelUrl')]
    public function testItCanGetCancelUrl($objTerminalTransaction): void
    {
        $this->assertEquals(method_exists($this->objTerminalTransaction, 'getCancelUrl'), true);
        $this->assertEquals('testCancelUrl', $objTerminalTransaction->getCancelUrl());
    }

    /**
     * @return TerminalTransaction
     */
    public function testItCanSetCancelUrl(): TerminalTransaction
    {
        $this->assertEquals(method_exists($this->objTerminalTransaction, 'setCancelUrl'), true);
        $this->objTerminalTransaction->setCancelUrl('testCancelUrl');
        return $this->objTerminalTransaction;
    }

    /**
     * @param $objTerminalTransaction
     * @return void
     */
    #[Depends('testItCanSetNextUrl')]
    public function testItCanGetNextUrl($objTerminalTransaction): void
    {
        $this->assertEquals(method_exists($this->objTerminalTransaction, 'getNextUrl'), true);
        $this->assertEquals('testNextUrl', $objTerminalTransaction->getNextUrl());
    }

    /**
     * @return TerminalTransaction
     */
    public function testItCanSetNextUrl(): TerminalTransaction
    {
        $this->assertEquals(method_exists($this->objTerminalTransaction, 'setNextUrl'), true);
        $this->objTerminalTransaction->setNextUrl('testNextUrl');
        return $this->objTerminalTransaction;
    }

    /**
     * @param $objTerminalTransaction
     * @return void
     */
    public function testItCanGetTerminal(): void
    {
        $this->assertEquals(method_exists($this->objTerminalTransaction, 'getTerminal'), true);
    }


    /**
     * @param $objTerminalTransaction
     * @return void
     */
    public function testItCanGetProgress(): void
    {
        $this->assertEquals(method_exists($this->objTerminalTransaction, 'getProgress'), true);
    }


    /**
     * @param $objTerminalTransaction
     * @return void
     */
    public function testItCanGetLinks(): void
    {
        $this->assertEquals(method_exists($this->objTerminalTransaction, 'getLinks'), true);
    }


}