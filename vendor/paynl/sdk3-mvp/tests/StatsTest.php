<?php

declare(strict_types=1);

use PHPUnit\Framework\Attributes\Depends;
use PHPUnit\Framework\TestCase;
use PayNL\Sdk\Model\Stats;

/**
 * Class StatsTest
 */
final class StatsTest extends TestCase
{
    /**
     * @var Stats
     */
    protected $objStats;

    /**
     * @return void
     */
    public function setUp(): void
    {
        $this->objStats = new Stats();
    }

    /**
     * @param $objStats
     * @return void
     */
    #[Depends('testItCanSetObject')]
    public function testItCanGetObject($objStats): void
    {
        $this->assertEquals(method_exists($this->objStats, 'getObject'), true);
        $this->assertEquals('testObject', $objStats->getObject());
    }

    /**
     * @return Stats
     */
    public function testItCanSetObject(): Stats
    {
        $this->assertEquals(method_exists($this->objStats, 'setObject'), true);
        $this->objStats->setObject('testObject');
        return $this->objStats;
    }

    /**
     * @param $objStats
     * @return void
     */
    #[Depends('testItCanSetInfo')]
    public function testItCanGetInfo($objStats): void
    {
        $this->assertEquals(method_exists($this->objStats, 'getInfo'), true);
        $this->assertEquals('testInfo', $objStats->getInfo());
    }

    /**
     * @return Stats
     */
    public function testItCanSetInfo(): Stats
    {
        $this->assertEquals(method_exists($this->objStats, 'setInfo'), true);
        $this->objStats->setInfo('testInfo');
        return $this->objStats;
    }

    /**
     * @param $objStats
     * @return void
     */
    #[Depends('testItCanSetTool')]
    public function testItCanGetTool($objStats): void
    {
        $this->assertEquals(method_exists($this->objStats, 'getTool'), true);
        $this->assertEquals('testTool', $objStats->getTool());
    }

    /**
     * @return Stats
     */
    public function testItCanSetTool(): Stats
    {
        $this->assertEquals(method_exists($this->objStats, 'setTool'), true);
        $this->objStats->setTool('testTool');
        return $this->objStats;
    }

    /**
     * @param $objStats
     * @return void
     */
    #[Depends('testItCanSetExtra1')]
    public function testItCanGetExtra1($objStats): void
    {
        $this->assertEquals(method_exists($this->objStats, 'getExtra1'), true);
        $this->assertEquals('testExtra1', $objStats->getExtra1());
    }

    /**
     * @return Stats
     */
    public function testItCanSetExtra1(): Stats
    {
        $this->assertEquals(method_exists($this->objStats, 'setExtra1'), true);
        $this->objStats->setExtra1('testExtra1');
        return $this->objStats;
    }

    /**
     * @param $objStats
     * @return void
     */
    #[Depends('testItCanSetExtra2')]
    public function testItCanGetExtra2($objStats): void
    {
        $this->assertEquals(method_exists($this->objStats, 'getExtra2'), true);
        $this->assertEquals('testExtra2', $objStats->getExtra2());
    }

    /**
     * @return Stats
     */
    public function testItCanSetExtra2(): Stats
    {
        $this->assertEquals(method_exists($this->objStats, 'setExtra2'), true);
        $this->objStats->setExtra2('testExtra2');
        return $this->objStats;
    }

    /**
     * @param $objStats
     * @return void
     */
    #[Depends('testItCanSetExtra3')]
    public function testItCanGetExtra3($objStats): void
    {
        $this->assertEquals(method_exists($this->objStats, 'getExtra3'), true);
        $this->assertEquals('testExtra3', $objStats->getExtra3());
    }

    /**
     * @return Stats
     */
    public function testItCanSetExtra3(): Stats
    {
        $this->assertEquals(method_exists($this->objStats, 'setExtra3'), true);
        $this->objStats->setExtra3('testExtra3');
        return $this->objStats;
    }

    /**
     * @param $objStats
     * @return void
     */
    public function testItCanGetDomainId(): void
    {
        $this->assertEquals(method_exists($this->objStats, 'getDomainId'), true);
    }


}