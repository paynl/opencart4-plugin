<?php

declare(strict_types=1);

use PHPUnit\Framework\Attributes\Depends;
use PHPUnit\Framework\TestCase;
use PayNL\Sdk\Model\Error;

/**
 * Class ErrorTest
 */
final class ErrorTest extends TestCase
{
    /**
     * @var Error
     */
    protected $objError;

    /**
     * @return void
     */
    public function setUp(): void
    {
        $this->objError = new Error();
    }

    /**
     * @param $objError
     * @return void
     */
    #[Depends('testItCanSetContext')]
    public function testItCanGetContext($objError): void
    {
        $this->assertEquals(method_exists($this->objError, 'getContext'), true);
        $this->assertEquals('testContext', $objError->getContext());
    }

    /**
     * @return Error
     */
    public function testItCanSetContext(): Error
    {
        $this->assertEquals(method_exists($this->objError, 'setContext'), true);
        $this->objError->setContext('testContext');
        return $this->objError;
    }

    /**
     * @param $objError
     * @return void
     */
    public function testItCanGetCode(): void
    {
        $this->assertEquals(method_exists($this->objError, 'getCode'), true);
    }


    /**
     * @param $objError
     * @return void
     */
    #[Depends('testItCanSetMessage')]
    public function testItCanGetMessage($objError): void
    {
        $this->assertEquals(method_exists($this->objError, 'getMessage'), true);
        $this->assertEquals('testMessage', $objError->getMessage());
    }

    /**
     * @return Error
     */
    public function testItCanSetMessage(): Error
    {
        $this->assertEquals(method_exists($this->objError, 'setMessage'), true);
        $this->objError->setMessage('testMessage');
        return $this->objError;
    }

}