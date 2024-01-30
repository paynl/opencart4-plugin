<?php

declare(strict_types=1);

use PHPUnit\Framework\Attributes\Depends;
use PHPUnit\Framework\TestCase;
use PayNL\Sdk\Model\Transaction;

/**
 * Class TransactionTest
 */
final class TransactionTest extends TestCase
{
    /**
     * @var Transaction
     */
    protected $objTransaction;

    /**
     * @return void
     */
    public function setUp(): void
    {
        $this->objTransaction = new Transaction();
    }

    /**
     * @param $objTransaction
     * @return void
     */
    #[Depends('testItCanSetId')]
    public function testItCanGetId($objTransaction): void
    {
        $this->assertEquals(method_exists($this->objTransaction, 'getId'), true);
        $this->assertEquals('testId', $objTransaction->getId());
    }

    /**
     * @return Transaction
     */
    public function testItCanSetId(): Transaction
    {
        $this->assertEquals(method_exists($this->objTransaction, 'setId'), true);
        $this->objTransaction->setId('testId');
        return $this->objTransaction;
    }

    /**
     * @param $objTransaction
     * @return void
     */
    #[Depends('testItCanSetServiceId')]
    public function testItCanGetServiceId($objTransaction): void
    {
        $this->assertEquals(method_exists($this->objTransaction, 'getServiceId'), true);
        $this->assertEquals('testServiceId', $objTransaction->getServiceId());
    }

    /**
     * @return Transaction
     */
    public function testItCanSetServiceId(): Transaction
    {
        $this->assertEquals(method_exists($this->objTransaction, 'setServiceId'), true);
        $this->objTransaction->setServiceId('testServiceId');
        return $this->objTransaction;
    }

    /**
     * @param $objTransaction
     * @return void
     */
    #[Depends('testItCanSetDescription')]
    public function testItCanGetDescription($objTransaction): void
    {
        $this->assertEquals(method_exists($this->objTransaction, 'getDescription'), true);
        $this->assertEquals('testDescription', $objTransaction->getDescription());
    }

    /**
     * @return Transaction
     */
    public function testItCanSetDescription(): Transaction
    {
        $this->assertEquals(method_exists($this->objTransaction, 'setDescription'), true);
        $this->objTransaction->setDescription('testDescription');
        return $this->objTransaction;
    }

    /**
     * @param $objTransaction
     * @return void
     */
    #[Depends('testItCanSetMerchantReference')]
    public function testItCanGetMerchantReference($objTransaction): void
    {
        $this->assertEquals(method_exists($this->objTransaction, 'getMerchantReference'), true);
        $this->assertEquals('testMerchantReference', $objTransaction->getMerchantReference());
    }

    /**
     * @return Transaction
     */
    public function testItCanSetMerchantReference(): Transaction
    {
        $this->assertEquals(method_exists($this->objTransaction, 'setMerchantReference'), true);
        $this->objTransaction->setMerchantReference('testMerchantReference');
        return $this->objTransaction;
    }

    /**
     * @param $objTransaction
     * @return void
     */
    #[Depends('testItCanSetLanguage')]
    public function testItCanGetLanguage($objTransaction): void
    {
        $this->assertEquals(method_exists($this->objTransaction, 'getLanguage'), true);
        $this->assertEquals('testLanguage', $objTransaction->getLanguage());
    }

    /**
     * @return Transaction
     */
    public function testItCanSetLanguage(): Transaction
    {
        $this->assertEquals(method_exists($this->objTransaction, 'setLanguage'), true);
        $this->objTransaction->setLanguage('testLanguage');
        return $this->objTransaction;
    }

    /**
     * @param $objTransaction
     * @return void
     */
    #[Depends('testItCanSetExpiresAt')]
    public function testItCanGetExpiresAt($objTransaction): void
    {
        $this->assertEquals(method_exists($this->objTransaction, 'getExpiresAt'), true);
        $this->assertEquals('testExpiresAt', $objTransaction->getExpiresAt());
    }

    /**
     * @return Transaction
     */
    public function testItCanSetExpiresAt(): Transaction
    {
        $this->assertEquals(method_exists($this->objTransaction, 'setExpiresAt'), true);
        $this->objTransaction->setExpiresAt('testExpiresAt');
        return $this->objTransaction;
    }

    /**
     * @param $objTransaction
     * @return void
     */
    public function testItCanGetAmountConverted(): void
    {
        $this->assertEquals(method_exists($this->objTransaction, 'getAmountConverted'), true);
    }


    /**
     * @param $objTransaction
     * @return void
     */
    public function testItCanGetAmountPaid(): void
    {
        $this->assertEquals(method_exists($this->objTransaction, 'getAmountPaid'), true);
    }


    /**
     * @param $objTransaction
     * @return void
     */
    public function testItCanGetAmountRefunded(): void
    {
        $this->assertEquals(method_exists($this->objTransaction, 'getAmountRefunded'), true);
    }


    /**
     * @param $objTransaction
     * @return void
     */
    #[Depends('testItCanSetReturnUrl')]
    public function testItCanGetReturnUrl($objTransaction): void
    {
        $this->assertEquals(method_exists($this->objTransaction, 'getReturnUrl'), true);
        $this->assertEquals('testReturnUrl', $objTransaction->getReturnUrl());
    }

    /**
     * @return Transaction
     */
    public function testItCanSetReturnUrl(): Transaction
    {
        $this->assertEquals(method_exists($this->objTransaction, 'setReturnUrl'), true);
        $this->objTransaction->setReturnUrl('testReturnUrl');
        return $this->objTransaction;
    }

    /**
     * @param $objTransaction
     * @return void
     */
    #[Depends('testItCanSetExchangeUrl')]
    public function testItCanGetExchangeUrl($objTransaction): void
    {
        $this->assertEquals(method_exists($this->objTransaction, 'getExchangeUrl'), true);
        $this->assertEquals('testExchangeUrl', $objTransaction->getExchangeUrl());
    }

    /**
     * @return Transaction
     */
    public function testItCanSetExchangeUrl(): Transaction
    {
        $this->assertEquals(method_exists($this->objTransaction, 'setExchangeUrl'), true);
        $this->objTransaction->setExchangeUrl('testExchangeUrl');
        return $this->objTransaction;
    }

    /**
     * @param $objTransaction
     * @return void
     */
    #[Depends('testItCanSetPaymentUrl')]
    public function testItCanGetPaymentUrl($objTransaction): void
    {
        $this->assertEquals(method_exists($this->objTransaction, 'getPaymentUrl'), true);
        $this->assertEquals('testPaymentUrl', $objTransaction->getPaymentUrl());
    }

    /**
     * @return Transaction
     */
    public function testItCanSetPaymentUrl(): Transaction
    {
        $this->assertEquals(method_exists($this->objTransaction, 'setPaymentUrl'), true);
        $this->objTransaction->setPaymentUrl('testPaymentUrl');
        return $this->objTransaction;
    }

    /**
     * @param $objTransaction
     * @return void
     */
    public function testItCanGetTransfer(): void
    {
        $this->assertEquals(method_exists($this->objTransaction, 'getTransfer'), true);
    }


    /**
     * @param $objTransaction
     * @return void
     */
    #[Depends('testItCanSetDomainId')]
    public function testItCanGetDomainId($objTransaction): void
    {
        $this->assertEquals(method_exists($this->objTransaction, 'getDomainId'), true);
        $this->assertEquals('testDomainId', $objTransaction->getDomainId());
    }

    /**
     * @return Transaction
     */
    public function testItCanSetDomainId(): Transaction
    {
        $this->assertEquals(method_exists($this->objTransaction, 'setDomainId'), true);
        $this->objTransaction->setDomainId('testDomainId');
        return $this->objTransaction;
    }

    /**
     * @param $objTransaction
     * @return void
     */
    public function testItCanGetIntegration(): void
    {
        $this->assertEquals(method_exists($this->objTransaction, 'getIntegration'), true);
    }


    /**
     * @param $objTransaction
     * @return void
     */
    #[Depends('testItCanSetOrderId')]
    public function testItCanGetOrderId($objTransaction): void
    {
        $this->assertEquals(method_exists($this->objTransaction, 'getOrderId'), true);
        $this->assertEquals('testOrderId', $objTransaction->getOrderId());
    }

    /**
     * @return Transaction
     */
    public function testItCanSetOrderId(): Transaction
    {
        $this->assertEquals(method_exists($this->objTransaction, 'setOrderId'), true);
        $this->objTransaction->setOrderId('testOrderId');
        return $this->objTransaction;
    }

    /**
     * @param $objTransaction
     * @return void
     */
    public function testItCanGetOrder(): void
    {
        $this->assertEquals(method_exists($this->objTransaction, 'getOrder'), true);
    }


    /**
     * @param $objTransaction
     * @return void
     */
    public function testItCanGetStatus(): void
    {
        $this->assertEquals(method_exists($this->objTransaction, 'getStatus'), true);
    }


    /**
     * @param $objTransaction
     * @return void
     */
    public function testItCanGetPaymentMethod(): void
    {
        $this->assertEquals(method_exists($this->objTransaction, 'getPaymentMethod'), true);
    }


    /**
     * @param $objTransaction
     * @return void
     */
    #[Depends('testItCanSetReference')]
    public function testItCanGetReference($objTransaction): void
    {
        $this->assertEquals(method_exists($this->objTransaction, 'getReference'), true);
        $this->assertEquals('testReference', $objTransaction->getReference());
    }

    /**
     * @return Transaction
     */
    public function testItCanSetReference(): Transaction
    {
        $this->assertEquals(method_exists($this->objTransaction, 'setReference'), true);
        $this->objTransaction->setReference('testReference');
        return $this->objTransaction;
    }

    /**
     * @param $objTransaction
     * @return void
     */
    public function testItCanGetLinks(): void
    {
        $this->assertEquals(method_exists($this->objTransaction, 'getLinks'), true);
    }


    /**
     * @param $objTransaction
     * @return void
     */
    public function testItCanGetAmount(): void
    {
        $this->assertEquals(method_exists($this->objTransaction, 'getAmount'), true);
    }


    /**
     * @param $objTransaction
     * @return void
     */
    public function testItCanGetStatistics(): void
    {
        $this->assertEquals(method_exists($this->objTransaction, 'getStatistics'), true);
    }


    /**
     * @param $objTransaction
     * @return void
     */
    public function testItCanGetNotification(): void
    {
        $this->assertEquals(method_exists($this->objTransaction, 'getNotification'), true);
    }


    /**
     * @param $objTransaction
     * @return void
     */
    #[Depends('testItCanSetCreatedAt')]
    public function testItCanGetCreatedAt($objTransaction): void
    {
        $this->assertEquals(method_exists($this->objTransaction, 'getCreatedAt'), true);
        $this->assertEquals('testCreatedAt', $objTransaction->getCreatedAt());
    }

    /**
     * @return Transaction
     */
    public function testItCanSetCreatedAt(): Transaction
    {
        $this->assertEquals(method_exists($this->objTransaction, 'setCreatedAt'), true);
        $this->objTransaction->setCreatedAt('testCreatedAt');
        return $this->objTransaction;
    }

}