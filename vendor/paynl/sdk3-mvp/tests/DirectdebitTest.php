<?php

declare(strict_types=1);

use PHPUnit\Framework\Attributes\Depends;
use PHPUnit\Framework\TestCase;
use PayNL\Sdk\Model\Directdebit;

/**
 * Class DirectdebitTest
 */
final class DirectdebitTest extends TestCase
{
    /**
     * @var Directdebit
     */
    protected $objDirectdebit;

    /**
     * @return void
     */
    public function setUp(): void
    {
        $this->objDirectdebit = new Directdebit();
    }

    /**
     * @param $objDirectdebit
     * @return void
     */
    #[Depends('testItCanSetId')]
    public function testItCanGetId($objDirectdebit): void
    {
        $this->assertEquals(method_exists($this->objDirectdebit, 'getId'), true);
        $this->assertEquals('testId', $objDirectdebit->getId());
    }

    /**
     * @return Directdebit
     */
    public function testItCanSetId(): Directdebit
    {
        $this->assertEquals(method_exists($this->objDirectdebit, 'setId'), true);
        $this->objDirectdebit->setId('testId');
        return $this->objDirectdebit;
    }

    /**
     * @param $objDirectdebit
     * @return void
     */
    #[Depends('testItCanSetPaymentSessionId')]
    public function testItCanGetPaymentSessionId($objDirectdebit): void
    {
        $this->assertEquals(method_exists($this->objDirectdebit, 'getPaymentSessionId'), true);
        $this->assertEquals('testPaymentSessionId', $objDirectdebit->getPaymentSessionId());
    }

    /**
     * @return Directdebit
     */
    public function testItCanSetPaymentSessionId(): Directdebit
    {
        $this->assertEquals(method_exists($this->objDirectdebit, 'setPaymentSessionId'), true);
        $this->objDirectdebit->setPaymentSessionId('testPaymentSessionId');
        return $this->objDirectdebit;
    }

    /**
     * @param $objDirectdebit
     * @return void
     */
    #[Depends('testItCanSetDescription')]
    public function testItCanGetDescription($objDirectdebit): void
    {
        $this->assertEquals(method_exists($this->objDirectdebit, 'getDescription'), true);
        $this->assertEquals('testDescription', $objDirectdebit->getDescription());
    }

    /**
     * @return Directdebit
     */
    public function testItCanSetDescription(): Directdebit
    {
        $this->assertEquals(method_exists($this->objDirectdebit, 'setDescription'), true);
        $this->objDirectdebit->setDescription('testDescription');
        return $this->objDirectdebit;
    }

    /**
     * @param $objDirectdebit
     * @return void
     */
    public function testItCanGetDeclined(): void
    {
        $this->assertEquals(method_exists($this->objDirectdebit, 'getDeclined'), true);
    }


    /**
     * @param $objDirectdebit
     * @return void
     */
    public function testItCanGetAmount(): void
    {
        $this->assertEquals(method_exists($this->objDirectdebit, 'getAmount'), true);
    }


    /**
     * @param $objDirectdebit
     * @return void
     */
    public function testItCanGetBankAccount(): void
    {
        $this->assertEquals(method_exists($this->objDirectdebit, 'getBankAccount'), true);
    }


    /**
     * @param $objDirectdebit
     * @return void
     */
    public function testItCanGetStatus(): void
    {
        $this->assertEquals(method_exists($this->objDirectdebit, 'getStatus'), true);
    }


}