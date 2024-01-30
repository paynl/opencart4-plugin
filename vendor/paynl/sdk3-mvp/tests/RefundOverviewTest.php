<?php

declare(strict_types=1);

use PHPUnit\Framework\Attributes\Depends;
use PHPUnit\Framework\TestCase;
use PayNL\Sdk\Model\RefundOverview;

/**
 * Class RefundOverviewTest
 */
final class RefundOverviewTest extends TestCase
{
    /**
     * @var RefundOverview
     */
    protected $objRefundOverview;

    /**
     * @return void
     */
    public function setUp(): void
    {
        $this->objRefundOverview = new RefundOverview();
    }

    /**
     * @param $objRefundOverview
     * @return void
     */
    #[Depends('testItCanSetDescription')]
    public function testItCanGetDescription($objRefundOverview): void
    {
        $this->assertEquals(method_exists($this->objRefundOverview, 'getDescription'), true);
        $this->assertEquals('testDescription', $objRefundOverview->getDescription());
    }

    /**
     * @return RefundOverview
     */
    public function testItCanSetDescription(): RefundOverview
    {
        $this->assertEquals(method_exists($this->objRefundOverview, 'setDescription'), true);
        $this->objRefundOverview->setDescription('testDescription');
        return $this->objRefundOverview;
    }

    /**
     * @param $objRefundOverview
     * @return void
     */
    public function testItCanGetAmountRefunded(): void
    {
        $this->assertEquals(method_exists($this->objRefundOverview, 'getAmountRefunded'), true);
    }


    /**
     * @param $objRefundOverview
     * @return void
     */
    public function testItCanGetRefundedTransactions(): void
    {
        $this->assertEquals(method_exists($this->objRefundOverview, 'getRefundedTransactions'), true);
    }


    /**
     * @param $objRefundOverview
     * @return void
     */
    public function testItCanGetFailedTransactions(): void
    {
        $this->assertEquals(method_exists($this->objRefundOverview, 'getFailedTransactions'), true);
    }


}