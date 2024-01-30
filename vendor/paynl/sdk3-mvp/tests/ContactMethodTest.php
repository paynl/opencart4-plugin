<?php

declare(strict_types=1);

use PHPUnit\Framework\Attributes\Depends;
use PHPUnit\Framework\TestCase;
use PayNL\Sdk\Model\ContactMethod;

/**
 * Class ContactMethodTest
 */
final class ContactMethodTest extends TestCase
{
    /**
     * @var ContactMethod
     */
    protected $objContactMethod;

    /**
     * @return void
     */
    public function setUp(): void
    {
        $this->objContactMethod = new ContactMethod();
    }

    /**
     * @param $objContactMethod
     * @return void
     */
    #[Depends('testItCanSetType')]
    public function testItCanGetType($objContactMethod): void
    {
        $this->assertEquals(method_exists($this->objContactMethod, 'getType'), true);
        $this->assertEquals('testType', $objContactMethod->getType());
    }

    /**
     * @return ContactMethod
     */
    public function testItCanSetType(): ContactMethod
    {
        $this->assertEquals(method_exists($this->objContactMethod, 'setType'), true);
        $this->objContactMethod->setType('testType');
        return $this->objContactMethod;
    }

    /**
     * @param $objContactMethod
     * @return void
     */
    #[Depends('testItCanSetValue')]
    public function testItCanGetValue($objContactMethod): void
    {
        $this->assertEquals(method_exists($this->objContactMethod, 'getValue'), true);
        $this->assertEquals('testValue', $objContactMethod->getValue());
    }

    /**
     * @return ContactMethod
     */
    public function testItCanSetValue(): ContactMethod
    {
        $this->assertEquals(method_exists($this->objContactMethod, 'setValue'), true);
        $this->objContactMethod->setValue('testValue');
        return $this->objContactMethod;
    }

    /**
     * @param $objContactMethod
     * @return void
     */
    #[Depends('testItCanSetDescription')]
    public function testItCanGetDescription($objContactMethod): void
    {
        $this->assertEquals(method_exists($this->objContactMethod, 'getDescription'), true);
        $this->assertEquals('testDescription', $objContactMethod->getDescription());
    }

    /**
     * @return ContactMethod
     */
    public function testItCanSetDescription(): ContactMethod
    {
        $this->assertEquals(method_exists($this->objContactMethod, 'setDescription'), true);
        $this->objContactMethod->setDescription('testDescription');
        return $this->objContactMethod;
    }

}