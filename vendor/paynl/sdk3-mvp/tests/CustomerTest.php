<?php

declare(strict_types=1);

use PHPUnit\Framework\Attributes\Depends;
use PHPUnit\Framework\TestCase;
use PayNL\Sdk\Model\Customer;

/**
 * Class CustomerTest
 */
final class CustomerTest extends TestCase
{
    /**
     * @var Customer
     */
    protected $objCustomer;
    
     /**
     * @return void
     */
    public function setUp(): void
    {
        $this->objCustomer = new Customer();
    }

    /**
     * @param $objCustomer
     * @return void
     */
    #[Depends('testItCanSetLastName')]
    public function testItCanGetLastName($objCustomer): void
    {
        $this->assertEquals(method_exists($this->objCustomer, 'getLastName'), true);
        $this->assertEquals('testLastName', $objCustomer->getLastName());
    }

    /**
     * @return Customer
     */
    public function testItCanSetLastName(): Customer
    {
        $this->assertEquals(method_exists($this->objCustomer, 'setLastName'), true);
        $this->objCustomer->setLastName('testLastName');
        return $this->objCustomer;
    }

    /**
     * @param $objCustomer
     * @return void
     */
    #[Depends('testItCanSetIpAddress')]
    public function testItCanGetIpAddress($objCustomer): void
    {
        $this->assertEquals(method_exists($this->objCustomer, 'getIpAddress'), true);
        $this->assertEquals('testIpAddress', $objCustomer->getIpAddress());
    }

    /**
     * @return Customer
     */
    public function testItCanSetIpAddress(): Customer
    {
        $this->assertEquals(method_exists($this->objCustomer, 'setIpAddress'), true);
        $this->objCustomer->setIpAddress('testIpAddress');
        return $this->objCustomer;
    }

    /**
     * @param $objCustomer
     * @return void
     */
    #[Depends('testItCanSetBirthDate')]
    public function testItCanGetBirthDate($objCustomer): void
    {
        $this->assertEquals(method_exists($this->objCustomer, 'getBirthDate'), true);
        $this->assertEquals('testBirthDate', $objCustomer->getBirthDate());
    }

    /**
     * @return Customer
     */
    public function testItCanSetBirthDate(): Customer
    {
        $this->assertEquals(method_exists($this->objCustomer, 'setBirthDate'), true);
        $this->objCustomer->setBirthDate('testBirthDate');
        return $this->objCustomer;
    }

    /**
     * @param $objCustomer
     * @return void
     */
    #[Depends('testItCanSetGender')]
    public function testItCanGetGender($objCustomer): void
    {
        $this->assertEquals(method_exists($this->objCustomer, 'getGender'), true);
        $this->assertEquals('MALE', $objCustomer->getGender());
    }

    /**
     * @return Customer
     */
    public function testItCanSetGender(): Customer
    {
        $this->assertEquals(method_exists($this->objCustomer, 'setGender'), true);
        $this->objCustomer->setGender('MALE');
        return $this->objCustomer;
    }

    /**
     * @param $objCustomer
     * @return void
     */
    #[Depends('testItCanSetPhone')]
    public function testItCanGetPhone($objCustomer): void
    {
        $this->assertEquals(method_exists($this->objCustomer, 'getPhone'), true);
        $this->assertEquals('testPhone', $objCustomer->getPhone());
    }

    /**
     * @return Customer
     */
    public function testItCanSetPhone(): Customer
    {
        $this->assertEquals(method_exists($this->objCustomer, 'setPhone'), true);
        $this->objCustomer->setPhone('testPhone');
        return $this->objCustomer;
    }

    /**
     * @param $objCustomer
     * @return void
     */
    #[Depends('testItCanSetEmail')]
    public function testItCanGetEmail($objCustomer): void
    {
        $this->assertEquals(method_exists($this->objCustomer, 'getEmail'), true);
        $this->assertEquals('testEmail', $objCustomer->getEmail());
    }

    /**
     * @return Customer
     */
    public function testItCanSetEmail(): Customer
    {
        $this->assertEquals(method_exists($this->objCustomer, 'setEmail'), true);
        $this->objCustomer->setEmail('testEmail');
        return $this->objCustomer;
    }

    /**
     * @param $objCustomer
     * @return void
     */
    #[Depends('testItCanSetTrust')]
    public function testItCanGetTrust($objCustomer): void
    {
        $this->assertEquals(method_exists($this->objCustomer, 'getTrust'), true);
        $this->assertEquals('10', $objCustomer->getTrust());
    }

    /**
     * @return Customer
     */
    public function testItCanSetTrust(): Customer
    {
        $this->assertEquals(method_exists($this->objCustomer, 'setTrust'), true);
        $this->objCustomer->setTrust('10');
        return $this->objCustomer;
    }

    /**
     * @param $objCustomer
     * @return void
     */
    #[Depends('testItCanSetReference')]
    public function testItCanGetReference($objCustomer): void
    {
        $this->assertEquals(method_exists($this->objCustomer, 'getReference'), true);
        $this->assertEquals('testReference', $objCustomer->getReference());
    }

    /**
     * @return Customer
     */
    public function testItCanSetReference(): Customer
    {
        $this->assertEquals(method_exists($this->objCustomer, 'setReference'), true);
        $this->objCustomer->setReference('testReference');
        return $this->objCustomer;
    }

    /**
     * @param $objCustomer
     * @return void
     */
    public function testItCanGetCompany(): void
    {
        $this->assertEquals(method_exists($this->objCustomer, 'getCompany'), true);
    }


    /**
     * @param $objCustomer
     * @return void
     */
    #[Depends('testItCanSetFirstName')]
    public function testItCanGetFirstName($objCustomer): void
    {
        $this->assertEquals(method_exists($this->objCustomer, 'getFirstName'), true);
        $this->assertEquals('testFirstName', $objCustomer->getFirstName());
    }

    /**
     * @return Customer
     */
    public function testItCanSetFirstName(): Customer
    {
        $this->assertEquals(method_exists($this->objCustomer, 'setFirstName'), true);
        $this->objCustomer->setFirstName('testFirstName');
        return $this->objCustomer;
    }

    /**
     * @param $objCustomer
     * @return void
     */
    #[Depends('testItCanSetLanguage')]
    public function testItCanGetLanguage($objCustomer): void
    {
        $this->assertEquals(method_exists($this->objCustomer, 'getLanguage'), true);
        $this->assertEquals('testLanguage', $objCustomer->getLanguage());
    }

    /**
     * @return Customer
     */
    public function testItCanSetLanguage(): Customer
    {
        $this->assertEquals(method_exists($this->objCustomer, 'setLanguage'), true);
        $this->objCustomer->setLanguage('testLanguage');
        return $this->objCustomer;
    }

    /**
     * @param $objCustomer
     * @return void
     */
    public function testItCanGetBankAccount(): void
    {
        $this->assertEquals(method_exists($this->objCustomer, 'getBankAccount'), true);
    }


}