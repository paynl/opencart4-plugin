<?php

declare(strict_types=1);

use PHPUnit\Framework\Attributes\Depends;
use PHPUnit\Framework\TestCase;
use PayNL\Sdk\Model\Language;

/**
 * Class LanguageTest
 */
final class LanguageTest extends TestCase
{
    /**
     * @var Language
     */
    protected $objLanguage;

    /**
     * @return void
     */
    public function setUp(): void
    {
        $this->objLanguage = new Language();
    }

    /**
     * @param $objLanguage
     * @return void
     */
    #[Depends('testItCanSetCode')]
    public function testItCanGetCode($objLanguage): void
    {
        $this->assertEquals(method_exists($this->objLanguage, 'getCode'), true);
        $this->assertEquals('testCode', $objLanguage->getCode());
    }

    /**
     * @return Language
     */
    public function testItCanSetCode(): Language
    {
        $this->assertEquals(method_exists($this->objLanguage, 'setCode'), true);
        $this->objLanguage->setCode('testCode');
        return $this->objLanguage;
    }

    /**
     * @param $objLanguage
     * @return void
     */
    #[Depends('testItCanSetName')]
    public function testItCanGetName($objLanguage): void
    {
        $this->assertEquals(method_exists($this->objLanguage, 'getName'), true);
        $this->assertEquals('testName', $objLanguage->getName());
    }

    /**
     * @return Language
     */
    public function testItCanSetName(): Language
    {
        $this->assertEquals(method_exists($this->objLanguage, 'setName'), true);
        $this->objLanguage->setName('testName');
        return $this->objLanguage;
    }

    /**
     * @param $objLanguage
     * @return void
     */
    public function testItCanGetAdminLanguageAvailable(): void
    {
        $this->assertEquals(method_exists($this->objLanguage, 'getAdminLanguageAvailable'), true);
    }


    /**
     * @param $objLanguage
     * @return void
     */
    public function testItCanGetHostedPaymentPageLanguageAvailable(): void
    {
        $this->assertEquals(method_exists($this->objLanguage, 'getHostedPaymentPageLanguageAvailable'), true);
    }


    /**
     * @param $objLanguage
     * @return void
     */
    public function testItCanGetPayerCommunicationLanguageAvailable(): void
    {
        $this->assertEquals(method_exists($this->objLanguage, 'getPayerCommunicationLanguageAvailable'), true);
    }


    /**
     * @param $objLanguage
     * @return void
     */
    public function testItCanGetContractLanguageAvailable(): void
    {
        $this->assertEquals(method_exists($this->objLanguage, 'getContractLanguageAvailable'), true);
    }


    /**
     * @param $objLanguage
     * @return void
     */
    #[Depends('testItCanSetImage')]
    public function testItCanGetImage($objLanguage): void
    {
        $this->assertEquals(method_exists($this->objLanguage, 'getImage'), true);
        $this->assertEquals('testImage', $objLanguage->getImage());
    }

    /**
     * @return Language
     */
    public function testItCanSetImage(): Language
    {
        $this->assertEquals(method_exists($this->objLanguage, 'setImage'), true);
        $this->objLanguage->setImage('testImage');
        return $this->objLanguage;
    }

    /**
     * @param $objLanguage
     * @return void
     */
    #[Depends('testItCanSetCreatedAt')]
    public function testItCanGetCreatedAt($objLanguage): void
    {
        $this->assertEquals(method_exists($this->objLanguage, 'getCreatedAt'), true);
        $this->assertEquals('testCreatedAt', $objLanguage->getCreatedAt());
    }

    /**
     * @return Language
     */
    public function testItCanSetCreatedAt(): Language
    {
        $this->assertEquals(method_exists($this->objLanguage, 'setCreatedAt'), true);
        $this->objLanguage->setCreatedAt('testCreatedAt');
        return $this->objLanguage;
    }

}