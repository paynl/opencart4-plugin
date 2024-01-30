<?php

declare(strict_types=1);

use PHPUnit\Framework\Attributes\Depends;
use PHPUnit\Framework\TestCase;
use PayNL\Sdk\Model\Link;

/**
 * Class LinkTest
 */
final class LinkTest extends TestCase
{
    /**
     * @var Link
     */
    protected $objLink;

    /**
     * @return void
     */
    public function setUp(): void
    {
        $this->objLink = new Link();
    }

    /**
     * @param $objLink
     * @return void
     */
    #[Depends('testItCanSetRel')]
    public function testItCanGetRel($objLink): void
    {
        $this->assertEquals(method_exists($this->objLink, 'getRel'), true);
        $this->assertEquals('testRel', $objLink->getRel());
    }

    /**
     * @return Link
     */
    public function testItCanSetRel(): Link
    {
        $this->assertEquals(method_exists($this->objLink, 'setRel'), true);
        $this->objLink->setRel('testRel');
        return $this->objLink;
    }

    /**
     * @param $objLink
     * @return void
     */
    #[Depends('testItCanSetType')]
    public function testItCanGetType($objLink): void
    {
        $this->assertEquals(method_exists($this->objLink, 'getType'), true);
        $this->assertEquals('testType', $objLink->getType());
    }

    /**
     * @return Link
     */
    public function testItCanSetType(): Link
    {
        $this->assertEquals(method_exists($this->objLink, 'setType'), true);
        $this->objLink->setType('testType');
        return $this->objLink;
    }

    /**
     * @param $objLink
     * @return void
     */
    #[Depends('testItCanSetUrl')]
    public function testItCanGetUrl($objLink): void
    {
        $this->assertEquals(method_exists($this->objLink, 'getUrl'), true);
        $this->assertEquals('testUrl', $objLink->getUrl());
    }

    /**
     * @return Link
     */
    public function testItCanSetUrl(): Link
    {
        $this->assertEquals(method_exists($this->objLink, 'setUrl'), true);
        $this->objLink->setUrl('testUrl');
        return $this->objLink;
    }

}