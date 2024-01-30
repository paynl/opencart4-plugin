<?php

declare(strict_types=1);

use PHPUnit\Framework\Attributes\Depends;
use PHPUnit\Framework\TestCase;
use PayNL\Sdk\Model\Amount;

/**
 * Class AmountTest
 */
final class AmountTest extends TestCase
{
    /**
     * @var Amount
     */
    protected $objAmount;

    /**
     * @return void
     */
    public function setUp(): void
    {
        $this->objAmount = new Amount();
    }

    /**
     * @param $objAmount
     * @return void
     */
    #[Depends('testItCanSetCurrency')]
    public function testItCanGetCurrency($objAmount): void
    {
        $this->assertEquals(method_exists($this->objAmount, 'getCurrency'), true);
        $this->assertEquals('testCurrency', $objAmount->getCurrency());
    }

    /**
     * @return Amount
     */
    public function testItCanSetCurrency(): Amount
    {
        $this->assertEquals(method_exists($this->objAmount, 'setCurrency'), true);
        $this->objAmount->setCurrency('testCurrency');
        return $this->objAmount;
    }

    /**
     * @param $objAmount
     * @return void
     */
    public function testItCanGetValue(): void
    {
        $this->assertEquals(method_exists($this->objAmount, 'getValue'), true);
    }


}