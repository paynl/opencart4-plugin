<?php

declare(strict_types=1);

use PHPUnit\Framework\Attributes\Depends;
use PHPUnit\Framework\TestCase;
use PayNL\Sdk\Model\ServicePaymentLink;

/**
 * Class ServicePaymentLinkTest
 */
final class ServicePaymentLinkTest extends TestCase
{
    /**
     * @var ServicePaymentLink
     */
    protected $objServicePaymentLink;

    /**
     * @return void
     */
    public function setUp(): void
    {
        $this->objServicePaymentLink = new ServicePaymentLink();
    }

    /**
     * @param $objServicePaymentLink
     * @return void
     */
    public function testItCanGetSecurityMode(): void
    {
        $this->assertEquals(method_exists($this->objServicePaymentLink, 'getSecurityMode'), true);
    }


    /**
     * @param $objServicePaymentLink
     * @return void
     */
    public function testItCanGetAmountMin(): void
    {
        $this->assertEquals(method_exists($this->objServicePaymentLink, 'getAmountMin'), true);
    }


    /**
     * @param $objServicePaymentLink
     * @return void
     */
    #[Depends('testItCanSetCountryCode')]
    public function testItCanGetCountryCode($objServicePaymentLink): void
    {
        $this->assertEquals(method_exists($this->objServicePaymentLink, 'getCountryCode'), true);
        $this->assertEquals('testCountryCode', $objServicePaymentLink->getCountryCode());
    }

    /**
     * @return ServicePaymentLink
     */
    public function testItCanSetCountryCode(): ServicePaymentLink
    {
        $this->assertEquals(method_exists($this->objServicePaymentLink, 'setCountryCode'), true);
        $this->objServicePaymentLink->setCountryCode('testCountryCode');
        return $this->objServicePaymentLink;
    }

    /**
     * @param $objServicePaymentLink
     * @return void
     */
    #[Depends('testItCanSetLanguage')]
    public function testItCanGetLanguage($objServicePaymentLink): void
    {
        $this->assertEquals(method_exists($this->objServicePaymentLink, 'getLanguage'), true);
        $this->assertEquals('testLanguage', $objServicePaymentLink->getLanguage());
    }

    /**
     * @return ServicePaymentLink
     */
    public function testItCanSetLanguage(): ServicePaymentLink
    {
        $this->assertEquals(method_exists($this->objServicePaymentLink, 'setLanguage'), true);
        $this->objServicePaymentLink->setLanguage('testLanguage');
        return $this->objServicePaymentLink;
    }

    /**
     * @param $objServicePaymentLink
     * @return void
     */
    #[Depends('testItCanSetUrl')]
    public function testItCanGetUrl($objServicePaymentLink): void
    {
        $this->assertEquals(method_exists($this->objServicePaymentLink, 'getUrl'), true);
        $this->assertEquals('testUrl', $objServicePaymentLink->getUrl());
    }

    /**
     * @return ServicePaymentLink
     */
    public function testItCanSetUrl(): ServicePaymentLink
    {
        $this->assertEquals(method_exists($this->objServicePaymentLink, 'setUrl'), true);
        $this->objServicePaymentLink->setUrl('testUrl');
        return $this->objServicePaymentLink;
    }

    /**
     * @param $objServicePaymentLink
     * @return void
     */
    public function testItCanGetAmount(): void
    {
        $this->assertEquals(method_exists($this->objServicePaymentLink, 'getAmount'), true);
    }


    /**
     * @param $objServicePaymentLink
     * @return void
     */
    public function testItCanGetStatistics(): void
    {
        $this->assertEquals(method_exists($this->objServicePaymentLink, 'getStatistics'), true);
    }


}