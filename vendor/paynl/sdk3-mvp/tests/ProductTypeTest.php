<?php

declare(strict_types=1);

use PHPUnit\Framework\Attributes\Depends;
use PHPUnit\Framework\TestCase;
use PayNL\Sdk\Model\ProductType;

/**
 * Class ProductTypeTest
 */
final class ProductTypeTest extends TestCase
{
    /**
     * @var ProductType
     */
    protected $objProductType;

    /**
     * @return void
     */
    public function setUp(): void
    {
        $this->objProductType = new ProductType();
    }

    /**
     * @param $objProductType
     * @return void
     */
    #[Depends('testItCanSetCode')]
    public function testItCanGetCode($objProductType): void
    {
        $this->assertEquals(method_exists($this->objProductType, 'getCode'), true);
        $this->assertEquals('testCode', $objProductType->getCode());
    }

    /**
     * @return ProductType
     */
    public function testItCanSetCode(): ProductType
    {
        $this->assertEquals(method_exists($this->objProductType, 'setCode'), true);
        $this->objProductType->setCode('testCode');
        return $this->objProductType;
    }

    /**
     * @param $objProductType
     * @return void
     */
    #[Depends('testItCanSetDescription')]
    public function testItCanGetDescription($objProductType): void
    {
        $this->assertEquals(method_exists($this->objProductType, 'getDescription'), true);
        $this->assertEquals('testDescription', $objProductType->getDescription());
    }

    /**
     * @return ProductType
     */
    public function testItCanSetDescription(): ProductType
    {
        $this->assertEquals(method_exists($this->objProductType, 'setDescription'), true);
        $this->objProductType->setDescription('testDescription');
        return $this->objProductType;
    }

    /**
     * @param $objProductType
     * @return void
     */
    #[Depends('testItCanSetImage')]
    public function testItCanGetImage($objProductType): void
    {
        $this->assertEquals(method_exists($this->objProductType, 'getImage'), true);
        $this->assertEquals('testImage', $objProductType->getImage());
    }

    /**
     * @return ProductType
     */
    public function testItCanSetImage(): ProductType
    {
        $this->assertEquals(method_exists($this->objProductType, 'setImage'), true);
        $this->objProductType->setImage('testImage');
        return $this->objProductType;
    }

    /**
     * @param $objProductType
     * @return void
     */
    #[Depends('testItCanSetCreatedAt')]
    public function testItCanGetCreatedAt($objProductType): void
    {
        $this->assertEquals(method_exists($this->objProductType, 'getCreatedAt'), true);
        $this->assertEquals('testCreatedAt', $objProductType->getCreatedAt());
    }

    /**
     * @return ProductType
     */
    public function testItCanSetCreatedAt(): ProductType
    {
        $this->assertEquals(method_exists($this->objProductType, 'setCreatedAt'), true);
        $this->objProductType->setCreatedAt('testCreatedAt');
        return $this->objProductType;
    }

}