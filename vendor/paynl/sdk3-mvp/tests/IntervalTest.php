<?php

declare(strict_types=1);

use PHPUnit\Framework\Attributes\Depends;
use PHPUnit\Framework\TestCase;
use PayNL\Sdk\Model\Interval;

/**
 * Class IntervalTest
 */
final class IntervalTest extends TestCase
{
    /**
     * @var Interval
     */
    protected $objInterval;

    /**
     * @return void
     */
    public function setUp(): void
    {
        $this->objInterval = new Interval();
    }

    /**
     * @param $objInterval
     * @return void
     */
    #[Depends('testItCanSetPeriod')]
    public function testItCanGetPeriod($objInterval): void
    {
        $this->assertEquals(method_exists($this->objInterval, 'getPeriod'), true);
        $this->assertEquals('testPeriod', $objInterval->getPeriod());
    }

    /**
     * @return Interval
     */
    public function testItCanSetPeriod(): Interval
    {
        $this->assertEquals(method_exists($this->objInterval, 'setPeriod'), true);
        $this->objInterval->setPeriod('testPeriod');
        return $this->objInterval;
    }

    /**
     * @param $objInterval
     * @return void
     */
    public function testItCanGetQuantity(): void
    {
        $this->assertEquals(method_exists($this->objInterval, 'getQuantity'), true);
    }

    /**
     * @param $objInterval
     * @return void
     */
    public function testItCanGetValue(): void
    {
        $this->assertEquals(method_exists($this->objInterval, 'getValue'), true);
    }

}