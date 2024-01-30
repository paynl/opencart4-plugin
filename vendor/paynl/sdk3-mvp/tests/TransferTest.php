<?php

declare(strict_types=1);

use PHPUnit\Framework\Attributes\Depends;
use PHPUnit\Framework\TestCase;
use PayNL\Sdk\Model\Transfer;

/**
 * Class TransferTest
 */
final class TransferTest extends TestCase
{
    /**
     * @var Transfer
     */
    protected $objTransfer;

    /**
     * @return void
     */
    public function setUp(): void
    {
        $this->objTransfer = new Transfer();
    }

    /**
     * @param $objTransfer
     * @return void
     */
    #[Depends('testItCanSetType')]
    public function testItCanGetType($objTransfer): void
    {
        $this->assertEquals(method_exists($this->objTransfer, 'getType'), true);
        $this->assertEquals('testType', $objTransfer->getType());
    }

    /**
     * @return Transfer
     */
    public function testItCanSetType(): Transfer
    {
        $this->assertEquals(method_exists($this->objTransfer, 'setType'), true);
        $this->objTransfer->setType('testType');
        return $this->objTransfer;
    }

    /**
     * @param $objTransfer
     * @return void
     */
    #[Depends('testItCanSetValue')]
    public function testItCanGetValue($objTransfer): void
    {
        $this->assertEquals(method_exists($this->objTransfer, 'getValue'), true);
        $this->assertEquals('testValue', $objTransfer->getValue());
    }

    /**
     * @return Transfer
     */
    public function testItCanSetValue(): Transfer
    {
        $this->assertEquals(method_exists($this->objTransfer, 'setValue'), true);
        $this->objTransfer->setValue('testValue');
        return $this->objTransfer;
    }

    /**
     * @param $objTransfer
     * @return void
     */
    public function testItCanGetData(): void
    {
        $this->assertEquals(method_exists($this->objTransfer, 'getData'), true);
    }


}