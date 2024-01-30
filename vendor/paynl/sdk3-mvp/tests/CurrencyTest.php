<?php

declare(strict_types=1);

use PHPUnit\Framework\Attributes\Depends;
use PHPUnit\Framework\TestCase;
use PayNL\Sdk\Model\Currency;

/**
 * Class CurrencyTest
 */
final class CurrencyTest extends TestCase
{
    /**
     * @var Currency
     */
    protected $objCurrency;

    /**
     * @return void
     */
    public function setUp(): void
    {
        $this->objCurrency = new Currency();
    }

    /**
     * @param $objCurrency
     * @return void
     */
    public function testItCanGetIsoCurrencyNumber(): void
    {
        $this->assertEquals(method_exists($this->objCurrency, 'getIsoCurrencyNumber'), true);
    }


    /**
     * @param $objCurrency
     * @return void
     */
    #[Depends('testItCanSetTag')]
    public function testItCanGetTag($objCurrency): void
    {
        $this->assertEquals(method_exists($this->objCurrency, 'getTag'), true);
        $this->assertEquals('testTag', $objCurrency->getTag());
    }

    /**
     * @return Currency
     */
    public function testItCanSetTag(): Currency
    {
        $this->assertEquals(method_exists($this->objCurrency, 'setTag'), true);
        $this->objCurrency->setTag('testTag');
        return $this->objCurrency;
    }

    /**
     * @param $objCurrency
     * @return void
     */
    #[Depends('testItCanSetName')]
    public function testItCanGetName($objCurrency): void
    {
        $this->assertEquals(method_exists($this->objCurrency, 'getName'), true);
        $this->assertEquals('testName', $objCurrency->getName());
    }

    /**
     * @return Currency
     */
    public function testItCanSetName(): Currency
    {
        $this->assertEquals(method_exists($this->objCurrency, 'setName'), true);
        $this->objCurrency->setName('testName');
        return $this->objCurrency;
    }

    /**
     * @param $objCurrency
     * @return void
     */
    #[Depends('testItCanSetDescription')]
    public function testItCanGetDescription($objCurrency): void
    {
        $this->assertEquals(method_exists($this->objCurrency, 'getDescription'), true);
        $this->assertEquals('testDescription', $objCurrency->getDescription());
    }

    /**
     * @return Currency
     */
    public function testItCanSetDescription(): Currency
    {
        $this->assertEquals(method_exists($this->objCurrency, 'setDescription'), true);
        $this->objCurrency->setDescription('testDescription');
        return $this->objCurrency;
    }

    /**
     * @param $objCurrency
     * @return void
     */
    public function testItCanGetId(): void
    {
        $this->assertEquals(method_exists($this->objCurrency, 'getId'), true);
    }


    /**
     * @param $objCurrency
     * @return void
     */
    #[Depends('testItCanSetSymbol')]
    public function testItCanGetSymbol($objCurrency): void
    {
        $this->assertEquals(method_exists($this->objCurrency, 'getSymbol'), true);
        $this->assertEquals('testSymbol', $objCurrency->getSymbol());
    }

    /**
     * @return Currency
     */
    public function testItCanSetSymbol(): Currency
    {
        $this->assertEquals(method_exists($this->objCurrency, 'setSymbol'), true);
        $this->objCurrency->setSymbol('testSymbol');
        return $this->objCurrency;
    }

    /**
     * @param $objCurrency
     * @return void
     */
    public function testItCanGetExchangeRate(): void
    {
        $this->assertEquals(method_exists($this->objCurrency, 'getExchangeRate'), true);
    }


    /**
     * @param $objCurrency
     * @return void
     */
    public function testItCanGetLinks(): void
    {
        $this->assertEquals(method_exists($this->objCurrency, 'getLinks'), true);
    }


}