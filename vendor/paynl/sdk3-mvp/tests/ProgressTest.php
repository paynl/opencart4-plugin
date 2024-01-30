<?php

declare(strict_types=1);

use PHPUnit\Framework\Attributes\Depends;
use PHPUnit\Framework\TestCase;
use PayNL\Sdk\Model\Progress;

/**
 * Class ProgressTest
 */
final class ProgressTest extends TestCase
{
    /**
     * @var Progress
     */
    protected $objProgress;

    /**
     * @return void
     */
    public function setUp(): void
    {
        $this->objProgress = new Progress();
    }

    /**
     * @param $objProgress
     * @return void
     */
    public function testItCanGetPercentage(): void
    {
        $this->assertEquals(method_exists($this->objProgress, 'getPercentage'), true);
    }


    /**
     * @param $objProgress
     * @return void
     */
    public function testItCanGetSecondsPassed(): void
    {
        $this->assertEquals(method_exists($this->objProgress, 'getSecondsPassed'), true);
    }


    /**
     * @param $objProgress
     * @return void
     */
    public function testItCanGetPercentagePerSecond(): void
    {
        $this->assertEquals(method_exists($this->objProgress, 'getPercentagePerSecond'), true);
    }


}