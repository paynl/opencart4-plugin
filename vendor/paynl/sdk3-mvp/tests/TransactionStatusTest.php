<?php

declare(strict_types=1);

use PHPUnit\Framework\Attributes\Depends;
use PHPUnit\Framework\TestCase;
use PayNL\Sdk\Model\TransactionStatus;

/**
 * Class TransactionStatusTest
 */
final class TransactionStatusTest extends TestCase
{
    /**
     * @var TransactionStatus
     */
    protected $objTransactionStatus;

    /**
     * @return void
     */
    public function setUp(): void
    {
        $this->objTransactionStatus = new TransactionStatus();
    }

    /**
     * @param $objTransactionStatus
     * @return void
     */
    public function testItCanGetAllowedStatus(): void
    {
        $this->assertEquals(method_exists($this->objTransactionStatus, 'getAllowedStatus'), true);
    }

    /**
     * @param $objTransactionStatus
     * @return void
     */
    public function testItCanGetCode(): void
    {
        $this->assertEquals(method_exists($this->objTransactionStatus, 'getCode'), true);
    }

    /**
     * @param $objTransactionStatus
     * @return void
     */
    #[Depends('testItCanSetPhase')]
    public function testItCanGetPhase($objTransactionStatus): void
    {
        $this->assertEquals(method_exists($this->objTransactionStatus, 'getPhase'), true);
        $this->assertEquals('testPhase', $objTransactionStatus->getPhase());
    }

    /**
     * @return TransactionStatus
     */
    public function testItCanSetPhase(): TransactionStatus
    {
        $this->assertEquals(method_exists($this->objTransactionStatus, 'setPhase'), true);
        $this->objTransactionStatus->setPhase('testPhase');
        return $this->objTransactionStatus;
    }

    /**
     * @param $objTransactionStatus
     * @return void
     */
    #[Depends('testItCanSetName')]
    public function testItCanGetName($objTransactionStatus): void
    {
        $this->assertEquals(method_exists($this->objTransactionStatus, 'getName'), true);
        $this->assertEquals('testName', $objTransactionStatus->getName());
    }

    /**
     * @return TransactionStatus
     */
    public function testItCanSetName(): TransactionStatus
    {
        $this->assertEquals(method_exists($this->objTransactionStatus, 'setName'), true);
        $this->objTransactionStatus->setName('testName');
        return $this->objTransactionStatus;
    }

    /**
     * @param $objTransactionStatus
     * @return void
     */
    public function testItCanGetDate(): void
    {
        $this->assertEquals(method_exists($this->objTransactionStatus, 'getDate'), true);
    }


    /**
     * @param $objTransactionStatus
     * @return void
     */
    #[Depends('testItCanSetReason')]
    public function testItCanGetReason($objTransactionStatus): void
    {
        $this->assertEquals(method_exists($this->objTransactionStatus, 'getReason'), true);
        $this->assertEquals('testReason', $objTransactionStatus->getReason());
    }

    /**
     * @return TransactionStatus
     */
    public function testItCanSetReason(): TransactionStatus
    {
        $this->assertEquals(method_exists($this->objTransactionStatus, 'setReason'), true);
        $this->objTransactionStatus->setReason('testReason');
        return $this->objTransactionStatus;
    }

}