<?php

declare(strict_types=1);

use PHPUnit\Framework\Attributes\Depends;
use PHPUnit\Framework\TestCase;
use PayNL\Sdk\Model\IpAddresses;

/**
 * Class IpAddressesTest
 */
final class IpAddressesTest extends TestCase
{
    /**
     * @var IpAddresses
     */
    protected $objIpAddresses;

    /**
     * @return void
     */
    public function setUp(): void
    {
        $this->objIpAddresses = new IpAddresses();
    }

    /**
     * @param $objIpAddresses
     * @return void
     */
    public function testItCanGetIpaddresses(): void
    {
        $this->assertEquals(method_exists($this->objIpAddresses, 'getIpaddresses'), true);
    }

    /**
     * @param $objIpAddresses
     * @return void
     */
    #[Depends('testItCanSetCreatedAt')]
    public function testItCanGetCreatedAt($objIpAddresses): void
    {
        $this->assertEquals(method_exists($this->objIpAddresses, 'getCreatedAt'), true);
        $this->assertEquals('testCreatedAt', $objIpAddresses->getCreatedAt());
    }

    /**
     * @return IpAddresses
     */
    public function testItCanSetCreatedAt(): IpAddresses
    {
        $this->assertEquals(method_exists($this->objIpAddresses, 'setCreatedAt'), true);
        $this->objIpAddresses->setCreatedAt('testCreatedAt');
        return $this->objIpAddresses;
    }

}