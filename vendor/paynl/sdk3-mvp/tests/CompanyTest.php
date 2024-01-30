<?php

declare(strict_types=1);

use PHPUnit\Framework\Attributes\Depends;
use PHPUnit\Framework\TestCase;
use PayNL\Sdk\Model\Company;

/**
 * Class CompanyTest
 */
final class CompanyTest extends TestCase
{
    /**
     * @var Company
     */
    protected $objCompany;

    /**
     * @return void
     */
    public function setUp(): void
    {
        $this->objCompany = new Company();
    }

    /**
     * @param $objCompany
     * @return void
     */
    #[Depends('testItCanSetName')]
    public function testItCanGetName($objCompany): void
    {
        $this->assertEquals(method_exists($this->objCompany, 'getName'), true);
        $this->assertEquals('testName', $objCompany->getName());
    }

    /**
     * @return Company
     */
    public function testItCanSetName(): Company
    {
        $this->assertEquals(method_exists($this->objCompany, 'setName'), true);
        $this->objCompany->setName('testName');
        return $this->objCompany;
    }

    /**
     * @param $objCompany
     * @return void
     */
    #[Depends('testItCanSetCoc')]
    public function testItCanGetCoc($objCompany): void
    {
        $this->assertEquals(method_exists($this->objCompany, 'getCoc'), true);
        $this->assertEquals('testCoc', $objCompany->getCoc());
    }

    /**
     * @return Company
     */
    public function testItCanSetCoc(): Company
    {
        $this->assertEquals(method_exists($this->objCompany, 'setCoc'), true);
        $this->objCompany->setCoc('testCoc');
        return $this->objCompany;
    }

    /**
     * @param $objCompany
     * @return void
     */
    #[Depends('testItCanSetVat')]
    public function testItCanGetVat($objCompany): void
    {
        $this->assertEquals(method_exists($this->objCompany, 'getVat'), true);
        $this->assertEquals('testVat', $objCompany->getVat());
    }

    /**
     * @return Company
     */
    public function testItCanSetVat(): Company
    {
        $this->assertEquals(method_exists($this->objCompany, 'setVat'), true);
        $this->objCompany->setVat('testVat');
        return $this->objCompany;
    }

    /**
     * @param $objCompany
     * @return void
     */
    #[Depends('testItCanSetCountryCode')]
    public function testItCanGetCountryCode($objCompany): void
    {
        $this->assertEquals(method_exists($this->objCompany, 'getCountryCode'), true);
        $this->assertEquals('testCountryCode', $objCompany->getCountryCode());
    }

    /**
     * @return Company
     */
    public function testItCanSetCountryCode(): Company
    {
        $this->assertEquals(method_exists($this->objCompany, 'setCountryCode'), true);
        $this->objCompany->setCountryCode('testCountryCode');
        return $this->objCompany;
    }

}