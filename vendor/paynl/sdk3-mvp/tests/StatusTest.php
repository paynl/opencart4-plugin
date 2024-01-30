<?php

declare(strict_types=1);

use PHPUnit\Framework\Attributes\Depends;
use PHPUnit\Framework\TestCase;
use PayNL\Sdk\Model\Status;

/**
 * Class StatusTest
 */
final class StatusTest extends TestCase
{
    /**
     * @var Status
     */
    protected $objStatus;

    /**
     * @return void
     */
    public function setUp(): void
    {
        $this->objStatus = new Status();
    }

    /**
     * @param $objStatus
     * @return void
     */
    public function testItCanGetCode(): void
    {
        $this->assertEquals(method_exists($this->objStatus, 'getCode'), true);
    }


    /**
     * @param $objStatus
     * @return void
     */
    #[Depends('testItCanSetName')]
    public function testItCanGetName($objStatus): void
    {
        $this->assertEquals(method_exists($this->objStatus, 'getName'), true);
        $this->assertEquals('testName', $objStatus->getName());
    }

    /**
     * @return Status
     */
    public function testItCanSetName(): Status
    {
        $this->assertEquals(method_exists($this->objStatus, 'setName'), true);
        $this->objStatus->setName('testName');
        return $this->objStatus;
    }

    /**
     * @param $objStatus
     * @return void
     */
    public function testItCanGetDate(): void
    {
        $this->assertEquals(method_exists($this->objStatus, 'getDate'), true);
    }


    /**
     * @param $objStatus
     * @return void
     */
    #[Depends('testItCanSetReason')]
    public function testItCanGetReason($objStatus): void
    {
        $this->assertEquals(method_exists($this->objStatus, 'getReason'), true);
        $this->assertEquals('testReason', $objStatus->getReason());
    }

    /**
     * @return Status
     */
    public function testItCanSetReason(): Status
    {
        $this->assertEquals(method_exists($this->objStatus, 'setReason'), true);
        $this->objStatus->setReason('testReason');
        return $this->objStatus;
    }

}