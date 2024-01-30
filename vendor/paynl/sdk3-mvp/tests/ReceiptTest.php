<?php

declare(strict_types=1);

use PHPUnit\Framework\Attributes\Depends;
use PHPUnit\Framework\TestCase;
use PayNL\Sdk\Model\Receipt;

/**
 * Class ReceiptTest
 */
final class ReceiptTest extends TestCase
{
    /**
     * @var Receipt
     */
    protected $objReceipt;

    /**
     * @return void
     */
    public function setUp(): void
    {
        $this->objReceipt = new Receipt();
    }

    /**
     * @param $objReceipt
     * @return void
     */
    #[Depends('testItCanSetId')]
    public function testItCanGetId($objReceipt): void
    {
        $this->assertEquals(method_exists($this->objReceipt, 'getId'), true);
        $this->assertEquals('testId', $objReceipt->getId());
    }

    /**
     * @return Receipt
     */
    public function testItCanSetId(): Receipt
    {
        $this->assertEquals(method_exists($this->objReceipt, 'setId'), true);
        $this->objReceipt->setId('testId');
        return $this->objReceipt;
    }

    /**
     * @param $objReceipt
     * @return void
     */
    #[Depends('testItCanSetSignature')]
    public function testItCanGetSignature($objReceipt): void
    {
        $this->assertEquals(method_exists($this->objReceipt, 'getSignature'), true);
        $this->assertEquals('testSignature', $objReceipt->getSignature());
    }

    /**
     * @return Receipt
     */
    public function testItCanSetSignature(): Receipt
    {
        $this->assertEquals(method_exists($this->objReceipt, 'setSignature'), true);
        $this->objReceipt->setSignature('testSignature');
        return $this->objReceipt;
    }

    /**
     * @param $objReceipt
     * @return void
     */
    #[Depends('testItCanSetApprovalId')]
    public function testItCanGetApprovalId($objReceipt): void
    {
        $this->assertEquals(method_exists($this->objReceipt, 'getApprovalId'), true);
        $this->assertEquals('testApprovalId', $objReceipt->getApprovalId());
    }

    /**
     * @return Receipt
     */
    public function testItCanSetApprovalId(): Receipt
    {
        $this->assertEquals(method_exists($this->objReceipt, 'setApprovalId'), true);
        $this->objReceipt->setApprovalId('testApprovalId');
        return $this->objReceipt;
    }

    /**
     * @param $objReceipt
     * @return void
     */
    public function testItCanGetCard(): void
    {
        $this->assertEquals(method_exists($this->objReceipt, 'getCard'), true);
    }


    /**
     * @param $objReceipt
     * @return void
     */
    public function testItCanGetLinks(): void
    {
        $this->assertEquals(method_exists($this->objReceipt, 'getLinks'), true);
    }


    /**
     * @param $objReceipt
     * @return void
     */
    public function testItCanGetPaymentMethod(): void
    {
        $this->assertEquals(method_exists($this->objReceipt, 'getPaymentMethod'), true);
    }


}