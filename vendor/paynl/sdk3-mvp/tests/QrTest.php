<?php

declare(strict_types=1);

use PHPUnit\Framework\Attributes\Depends;
use PHPUnit\Framework\TestCase;
use PayNL\Sdk\Model\Qr;

/**
 * Class QrTest
 */
final class QrTest extends TestCase
{
    /**
     * @var Qr
     */
    protected $objQr;

    /**
     * @return void
     */
    public function setUp(): void
    {
        $this->objQr = new Qr();
    }

    /**
     * @param $objQr
     * @return void
     */
    #[Depends('testItCanSetUuid')]
    public function testItCanGetUuid($objQr): void
    {
        $this->assertEquals(method_exists($this->objQr, 'getUuid'), true);
        $this->assertEquals('testUuid', $objQr->getUuid());
    }

    /**
     * @return Qr
     */
    public function testItCanSetUuid(): Qr
    {
        $this->assertEquals(method_exists($this->objQr, 'setUuid'), true);
        $this->objQr->setUuid('testUuid');
        return $this->objQr;
    }

    /**
     * @param $objQr
     * @return void
     */
    #[Depends('testItCanSetServiceId')]
    public function testItCanGetServiceId($objQr): void
    {
        $this->assertEquals(method_exists($this->objQr, 'getServiceId'), true);
        $this->assertEquals('testServiceId', $objQr->getServiceId());
    }

    /**
     * @return Qr
     */
    public function testItCanSetServiceId(): Qr
    {
        $this->assertEquals(method_exists($this->objQr, 'setServiceId'), true);
        $this->objQr->setServiceId('testServiceId');
        return $this->objQr;
    }

    /**
     * @param $objQr
     * @return void
     */
    #[Depends('testItCanSetSecret')]
    public function testItCanGetSecret($objQr): void
    {
        $this->assertEquals(method_exists($this->objQr, 'getSecret'), true);
        $this->assertEquals('testSecret', $objQr->getSecret());
    }

    /**
     * @return Qr
     */
    public function testItCanSetSecret(): Qr
    {
        $this->assertEquals(method_exists($this->objQr, 'setSecret'), true);
        $this->objQr->setSecret('testSecret');
        return $this->objQr;
    }

    /**
     * @param $objQr
     * @return void
     */
    #[Depends('testItCanSetReference')]
    public function testItCanGetReference($objQr): void
    {
        $this->assertEquals(method_exists($this->objQr, 'getReference'), true);
        $this->assertEquals('testReference', $objQr->getReference());
    }

    /**
     * @return Qr
     */
    public function testItCanSetReference(): Qr
    {
        $this->assertEquals(method_exists($this->objQr, 'setReference'), true);
        $this->objQr->setReference('testReference');
        return $this->objQr;
    }

    /**
     * @param $objQr
     * @return void
     */
    #[Depends('testItCanSetPadChar')]
    public function testItCanGetPadChar($objQr): void
    {
        $this->assertEquals(method_exists($this->objQr, 'getPadChar'), true);
        $this->assertEquals('testPadChar', $objQr->getPadChar());
    }

    /**
     * @return Qr
     */
    public function testItCanSetPadChar(): Qr
    {
        $this->assertEquals(method_exists($this->objQr, 'setPadChar'), true);
        $this->objQr->setPadChar('testPadChar');
        return $this->objQr;
    }

    /**
     * @param $objQr
     * @return void
     */
    #[Depends('testItCanSetReferenceType')]
    public function testItCanGetReferenceType($objQr): void
    {
        $this->assertEquals(method_exists($this->objQr, 'getReferenceType'), true);
        $this->assertEquals('string', $objQr->getReferenceType());
    }

    /**
     * @return Qr
     */
    public function testItCanSetReferenceType(): Qr
    {
        $this->assertEquals(method_exists($this->objQr, 'setReferenceType'), true);
        $this->objQr->setReferenceType('string');
        return $this->objQr;
    }

    /**
     * @param $objQr
     * @return void
     */
    #[Depends('testItCanSetExternalPaymentLink')]
    public function testItCanGetExternalPaymentLink($objQr): void
    {
        $this->assertEquals(method_exists($this->objQr, 'getExternalPaymentLink'), true);
        $this->assertEquals('testExternalPaymentLink', $objQr->getExternalPaymentLink());
    }

    /**
     * @return Qr
     */
    public function testItCanSetExternalPaymentLink(): Qr
    {
        $this->assertEquals(method_exists($this->objQr, 'setExternalPaymentLink'), true);
        $this->objQr->setExternalPaymentLink('testExternalPaymentLink');
        return $this->objQr;
    }

    /**
     * @param $objQr
     * @return void
     */
    #[Depends('testItCanSetPaymentLink')]
    public function testItCanGetPaymentLink($objQr): void
    {
        $this->assertEquals(method_exists($this->objQr, 'getPaymentLink'), true);
        $this->assertEquals('testPaymentLink', $objQr->getPaymentLink());
    }

    /**
     * @return Qr
     */
    public function testItCanSetPaymentLink(): Qr
    {
        $this->assertEquals(method_exists($this->objQr, 'setPaymentLink'), true);
        $this->objQr->setPaymentLink('testPaymentLink');
        return $this->objQr;
    }

    /**
     * @param $objQr
     * @return void
     */
    #[Depends('testItCanSetContents')]
    public function testItCanGetContents($objQr): void
    {
        $this->assertEquals(method_exists($this->objQr, 'getContents'), true);
        $this->assertEquals('testContents', $objQr->getContents());
    }

    /**
     * @return Qr
     */
    public function testItCanSetContents(): Qr
    {
        $this->assertEquals(method_exists($this->objQr, 'setContents'), true);
        $this->objQr->setContents('testContents');
        return $this->objQr;
    }

    /**
     * @param $objQr
     * @return void
     */
    public function testItCanGetAmount(): void
    {
        $this->assertEquals(method_exists($this->objQr, 'getAmount'), true);
    }


    /**
     * @param $objQr
     * @return void
     */
    public function testItCanGetPaymentMethod(): void
    {
        $this->assertEquals(method_exists($this->objQr, 'getPaymentMethod'), true);
    }


}