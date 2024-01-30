<?php

declare(strict_types=1);

use PHPUnit\Framework\Attributes\Depends;
use PHPUnit\Framework\TestCase;
use PayNL\Sdk\Model\Country;

/**
 * Class CountryTest
 */
final class CountryTest extends TestCase
{
    /**
     * @var Country
     */
    protected $objCountry;

    /**
     * @return void
     */
    public function setUp(): void
    {
        $this->objCountry = new Country();
    }

    /**
     * @param $objCountry
     * @return void
     */
    #[Depends('testItCanSetName')]
    public function testItCanGetName($objCountry): void
    {
        $this->assertEquals(method_exists($this->objCountry, 'getName'), true);
        $this->assertEquals('testName', $objCountry->getName());
    }

    /**
     * @return Country
     */
    public function testItCanSetName(): Country
    {
        $this->assertEquals(method_exists($this->objCountry, 'setName'), true);
        $this->objCountry->setName('testName');
        return $this->objCountry;
    }

    /**
     * @param $objCountry
     * @return void
     */
    #[Depends('testItCanSetCode')]
    public function testItCanGetCode($objCountry): void
    {
        $this->assertEquals(method_exists($this->objCountry, 'getCode'), true);
        $this->assertEquals('testCode', $objCountry->getCode());
    }

    /**
     * @return Country
     */
    public function testItCanSetCode(): Country
    {
        $this->assertEquals(method_exists($this->objCountry, 'setCode'), true);
        $this->objCountry->setCode('testCode');
        return $this->objCountry;
    }

    /**
     * @param $objCountry
     * @return void
     */
    public function testItCanGetIsoNumber(): void
    {
        $this->assertEquals(method_exists($this->objCountry, 'getIsoNumber'), true);
    }


    /**
     * @param $objCountry
     * @return void
     */
    #[Depends('testItCanSetNationality')]
    public function testItCanGetNationality($objCountry): void
    {
        $this->assertEquals(method_exists($this->objCountry, 'getNationality'), true);
        $this->assertEquals('testNationality', $objCountry->getNationality());
    }

    /**
     * @return Country
     */
    public function testItCanSetNationality(): Country
    {
        $this->assertEquals(method_exists($this->objCountry, 'setNationality'), true);
        $this->objCountry->setNationality('testNationality');
        return $this->objCountry;
    }

    /**
     * @param $objCountry
     * @return void
     */
    public function testItCanGetTranslations(): void
    {
        $this->assertEquals(method_exists($this->objCountry, 'getTranslations'), true);
    }


    /**
     * @param $objCountry
     * @return void
     */
    public function testItCanGetLocales(): void
    {
        $this->assertEquals(method_exists($this->objCountry, 'getLocales'), true);
    }


    /**
     * @param $objCountry
     * @return void
     */
    public function testItCanGetPhonePrefix(): void
    {
        $this->assertEquals(method_exists($this->objCountry, 'getPhonePrefix'), true);
    }


    /**
     * @param $objCountry
     * @return void
     */
    public function testItCanGetIbanLength(): void
    {
        $this->assertEquals(method_exists($this->objCountry, 'getIbanLength'), true);
    }


    /**
     * @param $objCountry
     * @return void
     */
    #[Depends('testItCanSetImage')]
    public function testItCanGetImage($objCountry): void
    {
        $this->assertEquals(method_exists($this->objCountry, 'getImage'), true);
        $this->assertEquals('testImage', $objCountry->getImage());
    }

    /**
     * @return Country
     */
    public function testItCanSetImage(): Country
    {
        $this->assertEquals(method_exists($this->objCountry, 'setImage'), true);
        $this->objCountry->setImage('testImage');
        return $this->objCountry;
    }

    /**
     * @param $objCountry
     * @return void
     */
    public function testItCanGetLinks(): void
    {
        $this->assertEquals(method_exists($this->objCountry, 'getLinks'), true);
    }


    /**
     * @param $objCountry
     * @return void
     */
    public function testItCanGetBankAccount(): void
    {
        $this->assertEquals(method_exists($this->objCountry, 'getBankAccount'), true);
    }


    /**
     * @param $objCountry
     * @return void
     */
    #[Depends('testItCanSetCreatedAt')]
    public function testItCanGetCreatedAt($objCountry): void
    {
        $this->assertEquals(method_exists($this->objCountry, 'getCreatedAt'), true);
        $this->assertEquals('testCreatedAt', $objCountry->getCreatedAt());
    }

    /**
     * @return Country
     */
    public function testItCanSetCreatedAt(): Country
    {
        $this->assertEquals(method_exists($this->objCountry, 'setCreatedAt'), true);
        $this->objCountry->setCreatedAt('testCreatedAt');
        return $this->objCountry;
    }

}