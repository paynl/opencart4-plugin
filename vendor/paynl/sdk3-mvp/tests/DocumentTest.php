<?php

declare(strict_types=1);

use PHPUnit\Framework\Attributes\Depends;
use PHPUnit\Framework\TestCase;
use PayNL\Sdk\Model\Document;

/**
 * Class DocumentTest
 */
final class DocumentTest extends TestCase
{
    /**
     * @var Document
     */
    protected $objDocument;

    /**
     * @return void
     */
    public function setUp(): void
    {
        $this->objDocument = new Document();
    }

    /**
     * @param $objDocument
     * @return void
     */
    public function testItCanGetDocument(): void
    {
        $this->assertEquals(method_exists($this->objDocument, 'getDocument'), true);
    }


    /**
     * @param $objDocument
     * @return void
     */
    public function testItCanGetLinks(): void
    {
        $this->assertEquals(method_exists($this->objDocument, 'getLinks'), true);
    }


}