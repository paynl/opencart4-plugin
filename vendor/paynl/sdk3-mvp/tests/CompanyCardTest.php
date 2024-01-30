<?php

declare(strict_types=1);

use PHPUnit\Framework\Attributes\Depends;
use PHPUnit\Framework\TestCase;
use PayNL\Sdk\Model\CompanyCard;

/**
 * Class CompanyCardTest
 */
final class CompanyCardTest extends TestCase
{
    /**
     * @var CompanyCard
     */
    protected $objCompanyCard;

    /**
     * @return void
     */
    public function setUp(): void
    {
        $this->objCompanyCard = new CompanyCard();
    }

    /**
     * @param $objCompanyCard
     * @return void
     */
    #[Depends('testItCanSetId')]
    public function testItCanGetId($objCompanyCard): void
    {
        $this->assertEquals(method_exists($this->objCompanyCard, 'getId'), true);
        $this->assertEquals('testId', $objCompanyCard->getId());
    }

    /**
     * @return CompanyCard
     */
    public function testItCanSetId(): CompanyCard
    {
        $this->assertEquals(method_exists($this->objCompanyCard, 'setId'), true);
        $this->objCompanyCard->setId('testId');
        return $this->objCompanyCard;
    }

    /**
     * @param $objCompanyCard
     * @return void
     */
    #[Depends('testItCanSetToken')]
    public function testItCanGetToken($objCompanyCard): void
    {
        $this->assertEquals(method_exists($this->objCompanyCard, 'getToken'), true);
        $this->assertEquals('testToken', $objCompanyCard->getToken());
    }

    /**
     * @return CompanyCard
     */
    public function testItCanSetToken(): CompanyCard
    {
        $this->assertEquals(method_exists($this->objCompanyCard, 'setToken'), true);
        $this->objCompanyCard->setToken('testToken');
        return $this->objCompanyCard;
    }

}