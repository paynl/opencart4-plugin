<?php

declare(strict_types=1);

use PHPUnit\Framework\Attributes\Depends;
use PHPUnit\Framework\TestCase;
use PayNL\Sdk\Model\Method;

/**
 * Class MethodTest
 */
final class MethodTest extends TestCase
{
    /**
     * @var Method
     */
    protected $objMethod;

    /**
     * @return void
     */
    public function setUp(): void
    {
        $this->objMethod = new Method();
    }

    /**
     * @param $objMethod
     * @return void
     */
    public function testItCanGetId(): void
    {
        $this->assertEquals(method_exists($this->objMethod, 'getId'), true);
    }


    /**
     * @param $objMethod
     * @return void
     */
    #[Depends('testItCanSetName')]
    public function testItCanGetName($objMethod): void
    {
        $this->assertEquals(method_exists($this->objMethod, 'getName'), true);
        $this->assertEquals('testName', $objMethod->getName());
    }

    /**
     * @return Method
     */
    public function testItCanSetName(): Method
    {
        $this->assertEquals(method_exists($this->objMethod, 'setName'), true);
        $this->objMethod->setName('testName');
        return $this->objMethod;
    }

    /**
     * @param $objMethod
     * @return void
     */
    public function testItCanGetTranslations(): void
    {
        $this->assertEquals(method_exists($this->objMethod, 'getTranslations'), true);
    }


    /**
     * @param $objMethod
     * @return void
     */
    #[Depends('testItCanSetImage')]
    public function testItCanGetImage($objMethod): void
    {
        $this->assertEquals(method_exists($this->objMethod, 'getImage'), true);
        $this->assertEquals('testImage', $objMethod->getImage());
    }

    /**
     * @return Method
     */
    public function testItCanSetImage(): Method
    {
        $this->assertEquals(method_exists($this->objMethod, 'setImage'), true);
        $this->objMethod->setImage('testImage');
        return $this->objMethod;
    }

    /**
     * @param $objMethod
     * @return void
     */
    public function testItCanGetOptions(): void
    {
        $this->assertEquals(method_exists($this->objMethod, 'getOptions'), true);
    }


    /**
     * @param $objMethod
     * @return void
     */
    public function testItCanGetSettings(): void
    {
        $this->assertEquals(method_exists($this->objMethod, 'getSettings'), true);
    }


    /**
     * @param $objMethod
     * @return void
     */
    #[Depends('testItCanSetCreatedAt')]
    public function testItCanGetCreatedAt($objMethod): void
    {
        $this->assertEquals(method_exists($this->objMethod, 'getCreatedAt'), true);
        $this->assertEquals('testCreatedAt', $objMethod->getCreatedAt());
    }

    /**
     * @return Method
     */
    public function testItCanSetCreatedAt(): Method
    {
        $this->assertEquals(method_exists($this->objMethod, 'setCreatedAt'), true);
        $this->objMethod->setCreatedAt('testCreatedAt');
        return $this->objMethod;
    }

}