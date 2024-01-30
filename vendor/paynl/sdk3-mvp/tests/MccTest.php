<?php

declare(strict_types=1);

use PHPUnit\Framework\Attributes\Depends;
use PHPUnit\Framework\TestCase;
use PayNL\Sdk\Model\Mcc;

/**
 * Class MccTest
 */
final class MccTest extends TestCase
{
    /**
     * @var Mcc
     */
    protected $objMcc;

    /**
     * @return void
     */
    public function setUp(): void
    {
        $this->objMcc = new Mcc();
    }

    /**
     * @param $objMcc
     * @return void
     */
    public function testItCanGetCode(): void
    {
        $this->assertEquals(method_exists($this->objMcc, 'getCode'), true);
    }


    /**
     * @param $objMcc
     * @return void
     */
    #[Depends('testItCanSetDescription')]
    public function testItCanGetDescription($objMcc): void
    {
        $this->assertEquals(method_exists($this->objMcc, 'getDescription'), true);
        $this->assertEquals('testDescription', $objMcc->getDescription());
    }

    /**
     * @return Mcc
     */
    public function testItCanSetDescription(): Mcc
    {
        $this->assertEquals(method_exists($this->objMcc, 'setDescription'), true);
        $this->objMcc->setDescription('testDescription');
        return $this->objMcc;
    }

    /**
     * @param $objMcc
     * @return void
     */
    public function testItCanGetHighRisk(): void
    {
        $this->assertEquals(method_exists($this->objMcc, 'getHighRisk'), true);
    }


}