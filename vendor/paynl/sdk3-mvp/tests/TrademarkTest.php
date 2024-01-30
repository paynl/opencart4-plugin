<?php

declare(strict_types=1);

use PHPUnit\Framework\Attributes\Depends;
use PHPUnit\Framework\TestCase;
use PayNL\Sdk\Model\Trademark;

/**
 * Class TrademarkTest
 */
final class TrademarkTest extends TestCase
{
    /**
     * @var Trademark
     */
    protected $objTrademark;

    /**
     * @return void
     */
    public function setUp(): void
    {
        $this->objTrademark = new Trademark();
    }

    /**
     * @param $objTrademark
     * @return void
     */
    #[Depends('testItCanSetId')]
    public function testItCanGetId($objTrademark): void
    {
        $this->assertEquals(method_exists($this->objTrademark, 'getId'), true);
        $this->assertEquals('testId', $objTrademark->getId());
    }

    /**
     * @return Trademark
     */
    public function testItCanSetId(): Trademark
    {
        $this->assertEquals(method_exists($this->objTrademark, 'setId'), true);
        $this->objTrademark->setId('testId');
        return $this->objTrademark;
    }

    /**
     * @param $objTrademark
     * @return void
     */
    #[Depends('testItCanSetName')]
    public function testItCanGetName($objTrademark): void
    {
        $this->assertEquals(method_exists($this->objTrademark, 'getName'), true);
        $this->assertEquals('testName', $objTrademark->getName());
    }

    /**
     * @return Trademark
     */
    public function testItCanSetName(): Trademark
    {
        $this->assertEquals(method_exists($this->objTrademark, 'setName'), true);
        $this->objTrademark->setName('testName');
        return $this->objTrademark;
    }

}