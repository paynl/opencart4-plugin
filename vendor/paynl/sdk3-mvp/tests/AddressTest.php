<?php

declare(strict_types=1);

use PHPUnit\Framework\Attributes\Depends;
use PHPUnit\Framework\TestCase;
use PayNL\Sdk\Model\Address;

/**
 * Class AddressTest
 */
final class AddressTest extends TestCase
{
    /**
     * @var Address
     */
    protected $objAddress;

    /**
     * @return void
     */
    public function setUp(): void
    {
        $this->objAddress = new Address();
    }

    /**
     * @param $objAddress
     * @return void
     */
    #[Depends('testItCanSetStreetName')]
    public function testItCanGetStreetName($objAddress): void
    {
        $this->assertEquals(method_exists($this->objAddress, 'getStreetName'), true);
        $this->assertEquals('testStreetName', $objAddress->getStreetName());
    }

    /**
     * @return Address
     */
    public function testItCanSetStreetName(): Address
    {
        $this->assertEquals(method_exists($this->objAddress, 'setStreetName'), true);
        $this->objAddress->setStreetName('testStreetName');
        return $this->objAddress;
    }

    /**
     * @param $objAddress
     * @return void
     */
    public function testItCanGetStreetNumber(): void
    {
        $this->assertEquals(method_exists($this->objAddress, 'getStreetNumber'), true);
    }


    /**
     * @param $objAddress
     * @return void
     */
    #[Depends('testItCanSetStreetNumberExtension')]
    public function testItCanGetStreetNumberExtension($objAddress): void
    {
        $this->assertEquals(method_exists($this->objAddress, 'getStreetNumberExtension'), true);
        $this->assertEquals('testStreetNumberExtension', $objAddress->getStreetNumberExtension());
    }

    /**
     * @return Address
     */
    public function testItCanSetStreetNumberExtension(): Address
    {
        $this->assertEquals(method_exists($this->objAddress, 'setStreetNumberExtension'), true);
        $this->objAddress->setStreetNumberExtension('testStreetNumberExtension');
        return $this->objAddress;
    }

    /**
     * @param $objAddress
     * @return void
     */
    #[Depends('testItCanSetZipCode')]
    public function testItCanGetZipCode($objAddress): void
    {
        $this->assertEquals(method_exists($this->objAddress, 'getZipCode'), true);
        $this->assertEquals('testZipCode', $objAddress->getZipCode());
    }

    /**
     * @return Address
     */
    public function testItCanSetZipCode(): Address
    {
        $this->assertEquals(method_exists($this->objAddress, 'setZipCode'), true);
        $this->objAddress->setZipCode('testZipCode');
        return $this->objAddress;
    }

    /**
     * @param $objAddress
     * @return void
     */
    #[Depends('testItCanSetCity')]
    public function testItCanGetCity($objAddress): void
    {
        $this->assertEquals(method_exists($this->objAddress, 'getCity'), true);
        $this->assertEquals('testCity', $objAddress->getCity());
    }

    /**
     * @return Address
     */
    public function testItCanSetCity(): Address
    {
        $this->assertEquals(method_exists($this->objAddress, 'setCity'), true);
        $this->objAddress->setCity('testCity');
        return $this->objAddress;
    }

    /**
     * @param $objAddress
     * @return void
     */
    #[Depends('testItCanSetRegionCode')]
    public function testItCanGetRegionCode($objAddress): void
    {
        $this->assertEquals(method_exists($this->objAddress, 'getRegionCode'), true);
        $this->assertEquals('testRegionCode', $objAddress->getRegionCode());
    }

    /**
     * @return Address
     */
    public function testItCanSetRegionCode(): Address
    {
        $this->assertEquals(method_exists($this->objAddress, 'setRegionCode'), true);
        $this->objAddress->setRegionCode('testRegionCode');
        return $this->objAddress;
    }

    /**
     * @param $objAddress
     * @return void
     */
    #[Depends('testItCanSetCountryCode')]
    public function testItCanGetCountryCode($objAddress): void
    {
        $this->assertEquals(method_exists($this->objAddress, 'getCountryCode'), true);
        $this->assertEquals('testCountryCode', $objAddress->getCountryCode());
    }

    /**
     * @return Address
     */
    public function testItCanSetCountryCode(): Address
    {
        $this->assertEquals(method_exists($this->objAddress, 'setCountryCode'), true);
        $this->objAddress->setCountryCode('testCountryCode');
        return $this->objAddress;
    }

    /**
     * @param $objAddress
     * @return void
     */
    #[Depends('testItCanSetCode')]
    public function testItCanGetCode($objAddress): void
    {
        $this->assertEquals(method_exists($this->objAddress, 'getCode'), true);
        $this->assertEquals('testCode', $objAddress->getCode());
    }

    /**
     * @return Address
     */
    public function testItCanSetCode(): Address
    {
        $this->assertEquals(method_exists($this->objAddress, 'setCode'), true);
        $this->objAddress->setCode('testCode');
        return $this->objAddress;
    }

}