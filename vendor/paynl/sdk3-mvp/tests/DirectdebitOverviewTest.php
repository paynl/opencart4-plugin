<?php

declare(strict_types=1);

use PHPUnit\Framework\Attributes\Depends;
use PHPUnit\Framework\TestCase;
use PayNL\Sdk\Model\DirectdebitOverview;

/**
 * Class DirectdebitOverviewTest
 */
final class DirectdebitOverviewTest extends TestCase
{
    /**
     * @var DirectdebitOverview
     */
    protected $objDirectdebitOverview;

    /**
     * @return void
     */
    public function setUp(): void
    {
        $this->objDirectdebitOverview = new DirectdebitOverview();
    }

    /**
     * @param $objDirectdebitOverview
     * @return void
     */
    public function testItCanGetMandate(): void
    {
        $this->assertEquals(method_exists($this->objDirectdebitOverview, 'getMandate'), true);
    }


    /**
     * @param $objDirectdebitOverview
     * @return void
     */
    public function testItCanGetDirectdebits(): void
    {
        $this->assertEquals(method_exists($this->objDirectdebitOverview, 'getDirectdebits'), true);
    }


    /**
     * @param $objDirectdebitOverview
     * @return void
     */
    public function testItCanGetLinks(): void
    {
        $this->assertEquals(method_exists($this->objDirectdebitOverview, 'getLinks'), true);
    }


}