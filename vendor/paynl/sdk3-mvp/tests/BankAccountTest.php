<?php

declare(strict_types=1);

use PHPUnit\Framework\Attributes\Depends;
use PHPUnit\Framework\TestCase;
use PayNL\Sdk\Model\BankAccount;

/**
 * Class BankAccountTest
 */
final class BankAccountTest extends TestCase
{
    /**
     * @var BankAccount
     */
    protected $objBankAccount;

    /**
     * @return void
     */
    public function setUp(): void
    {
        $this->objBankAccount = new BankAccount();
    }

    /**
     * @param $objBankAccount
     * @return void
     */
    #[Depends('testItCanSetBank')]
    public function testItCanGetBank($objBankAccount): void
    {
        $this->assertEquals(method_exists($this->objBankAccount, 'getBank'), true);
        $this->assertEquals('testBank', $objBankAccount->getBank());
    }

    /**
     * @return BankAccount
     */
    public function testItCanSetBank(): BankAccount
    {
        $this->assertEquals(method_exists($this->objBankAccount, 'setBank'), true);
        $this->objBankAccount->setBank('testBank');
        return $this->objBankAccount;
    }

    /**
     * @param $objBankAccount
     * @return void
     */
    #[Depends('testItCanSetIban')]
    public function testItCanGetIban($objBankAccount): void
    {
        $this->assertEquals(method_exists($this->objBankAccount, 'getIban'), true);
        $this->assertEquals('testIban', $objBankAccount->getIban());
    }

    /**
     * @return BankAccount
     */
    public function testItCanSetIban(): BankAccount
    {
        $this->assertEquals(method_exists($this->objBankAccount, 'setIban'), true);
        $this->objBankAccount->setIban('testIban');
        return $this->objBankAccount;
    }

    /**
     * @param $objBankAccount
     * @return void
     */
    #[Depends('testItCanSetBic')]
    public function testItCanGetBic($objBankAccount): void
    {
        $this->assertEquals(method_exists($this->objBankAccount, 'getBic'), true);
        $this->assertEquals('testBic', $objBankAccount->getBic());
    }

    /**
     * @return BankAccount
     */
    public function testItCanSetBic(): BankAccount
    {
        $this->assertEquals(method_exists($this->objBankAccount, 'setBic'), true);
        $this->objBankAccount->setBic('testBic');
        return $this->objBankAccount;
    }

    /**
     * @param $objBankAccount
     * @return void
     */
    #[Depends('testItCanSetOwner')]
    public function testItCanGetOwner($objBankAccount): void
    {
        $this->assertEquals(method_exists($this->objBankAccount, 'getOwner'), true);
        $this->assertEquals('testOwner', $objBankAccount->getOwner());
    }

    /**
     * @return BankAccount
     */
    public function testItCanSetOwner(): BankAccount
    {
        $this->assertEquals(method_exists($this->objBankAccount, 'setOwner'), true);
        $this->objBankAccount->setOwner('testOwner');
        return $this->objBankAccount;
    }

    /**
     * @param $objBankAccount
     * @return void
     */
    #[Depends('testItCanSetReturnUrl')]
    public function testItCanGetReturnUrl($objBankAccount): void
    {
        $this->assertEquals(method_exists($this->objBankAccount, 'getReturnUrl'), true);
        $this->assertEquals('testReturnUrl', $objBankAccount->getReturnUrl());
    }

    /**
     * @return BankAccount
     */
    public function testItCanSetReturnUrl(): BankAccount
    {
        $this->assertEquals(method_exists($this->objBankAccount, 'setReturnUrl'), true);
        $this->objBankAccount->setReturnUrl('testReturnUrl');
        return $this->objBankAccount;
    }

}