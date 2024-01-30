<?php

declare(strict_types=1);

use PHPUnit\Framework\Attributes\Depends;
use PHPUnit\Framework\TestCase;
use PayNL\Sdk\Model\Terminal;

/**
 * Class TerminalTest
 */
final class TerminalTest extends TestCase
{
    /**
     * @var Terminal
     */
    protected $objTerminal;

    /**
     * @return void
     */
    public function setUp(): void
    {
        $this->objTerminal = new Terminal();
    }

    /**
     * @param $objTerminal
     * @return void
     */
    #[Depends('testItCanSetId')]
    public function testItCanGetId($objTerminal): void
    {
        $this->assertEquals(method_exists($this->objTerminal, 'getId'), true);
        $this->assertEquals('testId', $objTerminal->getId());
    }

    /**
     * @return Terminal
     */
    public function testItCanSetId(): Terminal
    {
        $this->assertEquals(method_exists($this->objTerminal, 'setId'), true);
        $this->objTerminal->setId('testId');
        return $this->objTerminal;
    }

    /**
     * @param $objTerminal
     * @return void
     */
    #[Depends('testItCanSetName')]
    public function testItCanGetName($objTerminal): void
    {
        $this->assertEquals(method_exists($this->objTerminal, 'getName'), true);
        $this->assertEquals('testName', $objTerminal->getName());
    }

    /**
     * @return Terminal
     */
    public function testItCanSetName(): Terminal
    {
        $this->assertEquals(method_exists($this->objTerminal, 'setName'), true);
        $this->objTerminal->setName('testName');
        return $this->objTerminal;
    }

    /**
     * @param $objTerminal
     * @return void
     */
    #[Depends('testItCanSetEcrProtocol')]
    public function testItCanGetEcrProtocol($objTerminal): void
    {
        $this->assertEquals(method_exists($this->objTerminal, 'getEcrProtocol'), true);
        $this->assertEquals('testEcrProtocol', $objTerminal->getEcrProtocol());
    }

    /**
     * @return Terminal
     */
    public function testItCanSetEcrProtocol(): Terminal
    {
        $this->assertEquals(method_exists($this->objTerminal, 'setEcrProtocol'), true);
        $this->objTerminal->setEcrProtocol('testEcrProtocol');
        return $this->objTerminal;
    }

    /**
     * @param $objTerminal
     * @return void
     */
    #[Depends('testItCanSetState')]
    public function testItCanGetState($objTerminal): void
    {
        $this->assertEquals(method_exists($this->objTerminal, 'getState'), true);
        $this->assertEquals('all', $objTerminal->getState());
    }

    /**
     * @return Terminal
     */
    public function testItCanSetState(): Terminal
    {
        $this->assertEquals(method_exists($this->objTerminal, 'setState'), true);
        $this->objTerminal->setState('all');
        return $this->objTerminal;
    }

}