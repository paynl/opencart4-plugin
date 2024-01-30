<?php

declare(strict_types=1);

use PHPUnit\Framework\Attributes\Depends;
use PHPUnit\Framework\TestCase;
use PayNL\Sdk\Model\Mandate;

/**
 * Class MandateTest
 */
final class MandateTest extends TestCase
{
    /**
     * @var Mandate
     */
    protected $objMandate;

    /**
     * @return void
     */
    public function setUp(): void
    {
        $this->objMandate = new Mandate();
    }

    /**
     * @param $objMandate
     * @return void
     */
    #[Depends('testItCanSetId')]
    public function testItCanGetId($objMandate): void
    {
        $this->assertEquals(method_exists($this->objMandate, 'getId'), true);
        $this->assertEquals('testId', $objMandate->getId());
    }

    /**
     * @return Mandate
     */
    public function testItCanSetId(): Mandate
    {
        $this->assertEquals(method_exists($this->objMandate, 'setId'), true);
        $this->objMandate->setId('testId');
        return $this->objMandate;
    }

    /**
     * @param $objMandate
     * @return void
     */
    #[Depends('testItCanSetType')]
    public function testItCanGetType($objMandate): void
    {
        $this->assertEquals(method_exists($this->objMandate, 'getType'), true);
        $this->assertEquals('testType', $objMandate->getType());
    }

    /**
     * @return Mandate
     */
    public function testItCanSetType(): Mandate
    {
        $this->assertEquals(method_exists($this->objMandate, 'setType'), true);
        $this->objMandate->setType('testType');
        return $this->objMandate;
    }

    /**
     * @param $objMandate
     * @return void
     */
    #[Depends('testItCanSetServiceId')]
    public function testItCanGetServiceId($objMandate): void
    {
        $this->assertEquals(method_exists($this->objMandate, 'getServiceId'), true);
        $this->assertEquals('testServiceId', $objMandate->getServiceId());
    }

    /**
     * @return Mandate
     */
    public function testItCanSetServiceId(): Mandate
    {
        $this->assertEquals(method_exists($this->objMandate, 'setServiceId'), true);
        $this->objMandate->setServiceId('testServiceId');
        return $this->objMandate;
    }

    /**
     * @param $objMandate
     * @return void
     */
    public function testItCanGetProcessDate(): void
    {
        $this->assertEquals(method_exists($this->objMandate, 'getProcessDate'), true);
    }


    /**
     * @param $objMandate
     * @return void
     */
    #[Depends('testItCanSetExchangeUrl')]
    public function testItCanGetExchangeUrl($objMandate): void
    {
        $this->assertEquals(method_exists($this->objMandate, 'getExchangeUrl'), true);
        $this->assertEquals('testExchangeUrl', $objMandate->getExchangeUrl());
    }

    /**
     * @return Mandate
     */
    public function testItCanSetExchangeUrl(): Mandate
    {
        $this->assertEquals(method_exists($this->objMandate, 'setExchangeUrl'), true);
        $this->objMandate->setExchangeUrl('testExchangeUrl');
        return $this->objMandate;
    }

    /**
     * @param $objMandate
     * @return void
     */
    #[Depends('testItCanSetDescription')]
    public function testItCanGetDescription($objMandate): void
    {
        $this->assertEquals(method_exists($this->objMandate, 'getDescription'), true);
        $this->assertEquals('testDescription', $objMandate->getDescription());
    }

    /**
     * @return Mandate
     */
    public function testItCanSetDescription(): Mandate
    {
        $this->assertEquals(method_exists($this->objMandate, 'setDescription'), true);
        $this->objMandate->setDescription('testDescription');
        return $this->objMandate;
    }

    /**
     * @param $objMandate
     * @return void
     */
    public function testItCanGetInterval(): void
    {
        $this->assertEquals(method_exists($this->objMandate, 'getInterval'), true);
    }


    /**
     * @param $objMandate
     * @return void
     */
    public function testItCanGetCustomer(): void
    {
        $this->assertEquals(method_exists($this->objMandate, 'getCustomer'), true);
    }


    /**
     * @param $objMandate
     * @return void
     */
    #[Depends('testItCanSetState')]
    public function testItCanGetState($objMandate): void
    {
        $this->assertEquals(method_exists($this->objMandate, 'getState'), true);
        $this->assertEquals('testState', $objMandate->getState());
    }

    /**
     * @return Mandate
     */
    public function testItCanSetState(): Mandate
    {
        $this->assertEquals(method_exists($this->objMandate, 'setState'), true);
        $this->objMandate->setState('testState');
        return $this->objMandate;
    }

    /**
     * @param $objMandate
     * @return void
     */
    public function testItCanGetAmount(): void
    {
        $this->assertEquals(method_exists($this->objMandate, 'getAmount'), true);
    }


    /**
     * @param $objMandate
     * @return void
     */
    public function testItCanGetStatistics(): void
    {
        $this->assertEquals(method_exists($this->objMandate, 'getStatistics'), true);
    }


}