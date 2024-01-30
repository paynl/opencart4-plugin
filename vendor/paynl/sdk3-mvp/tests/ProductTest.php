<?php

declare(strict_types=1);

use PHPUnit\Framework\Attributes\Depends;
use PHPUnit\Framework\TestCase;
use PayNL\Sdk\Model\Product;

/**
 * Class ProductTest
 */
final class ProductTest extends TestCase
{
    /**
     * @var Product
     */
    protected $objProduct;

    /**
     * @return void
     */
    public function setUp(): void
    {
        $this->objProduct = new Product();
    }


    /**
     * @param $objProduct
     * @return void
     */
    #[Depends('testItCanSetId')]
    public function testItCanGetId($objProduct): void
    {
        $this->assertEquals(method_exists($this->objProduct, 'getId'), true);
        $this->assertEquals('testId', $objProduct->getId());
    }

    /**
     * @return Product
     */
    public function testItCanSetId(): Product
    {
        $this->assertEquals(method_exists($this->objProduct, 'setId'), true);
        $this->objProduct->setId('testId');
        return $this->objProduct;
    }

    /**
     * @param $objProduct
     * @return void
     */
    #[Depends('testItCanSetType')]
    public function testItCanGetType($objProduct): void
    {
        $this->assertEquals(method_exists($this->objProduct, 'getType'), true);
        $this->assertEquals('testType', $objProduct->getType());
    }

    /**
     * @return Product
     */
    public function testItCanSetType(): Product
    {
        $this->assertEquals(method_exists($this->objProduct, 'setType'), true);
        $this->objProduct->setType('testType');
        return $this->objProduct;
    }

    /**
     * @param $objProduct
     * @return void
     */
    #[Depends('testItCanSetDescription')]
    public function testItCanGetDescription($objProduct): void
    {
        $this->assertEquals(method_exists($this->objProduct, 'getDescription'), true);
        $this->assertEquals('testDescription', $objProduct->getDescription());
    }

    /**
     * @return Product
     */
    public function testItCanSetDescription(): Product
    {
        $this->assertEquals(method_exists($this->objProduct, 'setDescription'), true);
        $this->objProduct->setDescription('testDescription');
        return $this->objProduct;
    }

    /**
     * @param $objProduct
     * @return void
     */
    public function testItCanGetPrice(): void
    {
        $this->assertEquals(method_exists($this->objProduct, 'getPrice'), true);
    }


    /**
     * @param $objProduct
     * @return void
     */
    public function testItCanGetQuantity(): void
    {
        $this->assertEquals(method_exists($this->objProduct, 'getQuantity'), true);
    }


    /**
     * @param $objProduct
     * @return void
     */
    #[Depends('testItCanSetVatCode')]
    public function testItCanGetVatCode($objProduct): void
    {
        $this->assertEquals(method_exists($this->objProduct, 'getVatCode'), true);
        $this->assertEquals('testVatCode', $objProduct->getVatCode());
    }

    /**
     * @return Product
     */
    public function testItCanSetVatCode(): Product
    {
        $this->assertEquals(method_exists($this->objProduct, 'setVatCode'), true);
        $this->objProduct->setVatCode('testVatCode');
        return $this->objProduct;
    }

}