<?php

declare(strict_types=1);

use PHPUnit\Framework\Attributes\Depends;
use PHPUnit\Framework\TestCase;
use PayNL\Sdk\Model\Service;

/**
 * Class ServiceTest
 */
final class ServiceTest extends TestCase
{
    /**
     * @var Service
     */
    protected $objService;

    /**
     * @return void
     */
    public function setUp(): void
    {
        $this->objService = new Service();
    }

    /**
     * @param $objService
     * @return void
     */
    #[Depends('testItCanSetId')]
    public function testItCanGetId($objService): void
    {
        $this->assertEquals(method_exists($this->objService, 'getId'), true);
        $this->assertEquals('testId', $objService->getId());
    }

    /**
     * @return Service
     */
    public function testItCanSetId(): Service
    {
        $this->assertEquals(method_exists($this->objService, 'setId'), true);
        $this->objService->setId('testId');
        return $this->objService;
    }

    /**
     * @param $objService
     * @return void
     */
    #[Depends('testItCanSetName')]
    public function testItCanGetName($objService): void
    {
        $this->assertEquals(method_exists($this->objService, 'getName'), true);
        $this->assertEquals('testName', $objService->getName());
    }

    /**
     * @return Service
     */
    public function testItCanSetName(): Service
    {
        $this->assertEquals(method_exists($this->objService, 'setName'), true);
        $this->objService->setName('testName');
        return $this->objService;
    }

    /**
     * @param $objService
     * @return void
     */
    #[Depends('testItCanSetDescription')]
    public function testItCanGetDescription($objService): void
    {
        $this->assertEquals(method_exists($this->objService, 'getDescription'), true);
        $this->assertEquals('testDescription', $objService->getDescription());
    }

    /**
     * @return Service
     */
    public function testItCanSetDescription(): Service
    {
        $this->assertEquals(method_exists($this->objService, 'setDescription'), true);
        $this->objService->setDescription('testDescription');
        return $this->objService;
    }


    /**
     * @param $objService
     * @return void
     */
    #[Depends('testItCanSetSecret')]
    public function testItCanGetSecret($objService): void
    {
        $this->assertEquals(method_exists($this->objService, 'getSecret'), true);
        $this->assertEquals('testSecret', $objService->getSecret());
    }

    /**
     * @return Service
     */
    public function testItCanSetSecret(): Service
    {
        $this->assertEquals(method_exists($this->objService, 'setSecret'), true);
        $this->objService->setSecret('testSecret');
        return $this->objService;
    }

    /**
     * @param $objService
     * @return void
     */
    public function testItCanGetLinks(): void
    {
        $this->assertEquals(method_exists($this->objService, 'getLinks'), true);
    }


    /**
     * @param $objService
     * @return void
     */
    #[Depends('testItCanSetCreatedAt')]
    public function testItCanGetCreatedAt($objService): void
    {
        $this->assertEquals(method_exists($this->objService, 'getCreatedAt'), true);
        $this->assertEquals('testCreatedAt', $objService->getCreatedAt());
    }

    /**
     * @return Service
     */
    public function testItCanSetCreatedAt(): Service
    {
        $this->assertEquals(method_exists($this->objService, 'setCreatedAt'), true);
        $this->objService->setCreatedAt('testCreatedAt');
        return $this->objService;
    }

}