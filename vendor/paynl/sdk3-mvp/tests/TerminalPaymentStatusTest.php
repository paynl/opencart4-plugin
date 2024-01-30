<?php

declare(strict_types=1);

use PHPUnit\Framework\Attributes\Depends;
use PHPUnit\Framework\TestCase;
use PayNL\Sdk\Model\TerminalPaymentStatus;

/**
 * Class TerminalPaymentStatusTest
 */
final class TerminalPaymentStatusTest extends TestCase
{
    /**
     * @var TerminalPaymentStatus
     */
    protected $objTerminalPaymentStatus;

    /**
     * @return void
     */
    public function setUp(): void
    {
        $this->objTerminalPaymentStatus = new TerminalPaymentStatus();
    }

    /**
     * @param $objTerminalPaymentStatus
     * @return void
     */
    #[Depends('testItCanSetStatus')]
    public function testItCanGetStatus($objTerminalPaymentStatus): void
    {
        $this->assertEquals(method_exists($this->objTerminalPaymentStatus, 'getStatus'), true);
        $this->assertEquals('testStatus', $objTerminalPaymentStatus->getStatus());
    }

    /**
     * @return TerminalPaymentStatus
     */
    public function testItCanSetStatus(): TerminalPaymentStatus
    {
        $this->assertEquals(method_exists($this->objTerminalPaymentStatus, 'setStatus'), true);
        $this->objTerminalPaymentStatus->setStatus('testStatus');
        return $this->objTerminalPaymentStatus;
    }

    /**
     * @param $objTerminalPaymentStatus
     * @return void
     */
    #[Depends('testItCanSetTxid')]
    public function testItCanGetTxid($objTerminalPaymentStatus): void
    {
        $this->assertEquals(method_exists($this->objTerminalPaymentStatus, 'getTxid'), true);
        $this->assertEquals('testTxid', $objTerminalPaymentStatus->getTxid());
    }

    /**
     * @return TerminalPaymentStatus
     */
    public function testItCanSetTxid(): TerminalPaymentStatus
    {
        $this->assertEquals(method_exists($this->objTerminalPaymentStatus, 'setTxid'), true);
        $this->objTerminalPaymentStatus->setTxid('testTxid');
        return $this->objTerminalPaymentStatus;
    }

    /**
     * @param $objTerminalPaymentStatus
     * @return void
     */
    #[Depends('testItCanSetTerminal')]
    public function testItCanGetTerminal($objTerminalPaymentStatus): void
    {
        $this->assertEquals(method_exists($this->objTerminalPaymentStatus, 'getTerminal'), true);
        $this->assertEquals('testTerminal', $objTerminalPaymentStatus->getTerminal());
    }

    /**
     * @return TerminalPaymentStatus
     */
    public function testItCanSetTerminal(): TerminalPaymentStatus
    {
        $this->assertEquals(method_exists($this->objTerminalPaymentStatus, 'setTerminal'), true);
        $this->objTerminalPaymentStatus->setTerminal('testTerminal');
        return $this->objTerminalPaymentStatus;
    }

    /**
     * @param $objTerminalPaymentStatus
     * @return void
     */
    #[Depends('testItCanSetSsai')]
    public function testItCanGetSsai($objTerminalPaymentStatus): void
    {
        $this->assertEquals(method_exists($this->objTerminalPaymentStatus, 'getSsai'), true);
        $this->assertEquals('testSsai', $objTerminalPaymentStatus->getSsai());
    }

    /**
     * @return TerminalPaymentStatus
     */
    public function testItCanSetSsai(): TerminalPaymentStatus
    {
        $this->assertEquals(method_exists($this->objTerminalPaymentStatus, 'setSsai'), true);
        $this->objTerminalPaymentStatus->setSsai('testSsai');
        return $this->objTerminalPaymentStatus;
    }

    /**
     * @param $objTerminalPaymentStatus
     * @return void
     */
    #[Depends('testItCanSetCardbrandlabelname')]
    public function testItCanGetCardbrandlabelname($objTerminalPaymentStatus): void
    {
        $this->assertEquals(method_exists($this->objTerminalPaymentStatus, 'getCardbrandlabelname'), true);
        $this->assertEquals('testCardbrandlabelname', $objTerminalPaymentStatus->getCardbrandlabelname());
    }

    /**
     * @return TerminalPaymentStatus
     */
    public function testItCanSetCardbrandlabelname(): TerminalPaymentStatus
    {
        $this->assertEquals(method_exists($this->objTerminalPaymentStatus, 'setCardbrandlabelname'), true);
        $this->objTerminalPaymentStatus->setCardbrandlabelname('testCardbrandlabelname');
        return $this->objTerminalPaymentStatus;
    }

    /**
     * @param $objTerminalPaymentStatus
     * @return void
     */
    #[Depends('testItCanSetCardbrandidentifier')]
    public function testItCanGetCardbrandidentifier($objTerminalPaymentStatus): void
    {
        $this->assertEquals(method_exists($this->objTerminalPaymentStatus, 'getCardbrandidentifier'), true);
        $this->assertEquals('testCardbrandidentifier', $objTerminalPaymentStatus->getCardbrandidentifier());
    }

    /**
     * @return TerminalPaymentStatus
     */
    public function testItCanSetCardbrandidentifier(): TerminalPaymentStatus
    {
        $this->assertEquals(method_exists($this->objTerminalPaymentStatus, 'setCardbrandidentifier'), true);
        $this->objTerminalPaymentStatus->setCardbrandidentifier('testCardbrandidentifier');
        return $this->objTerminalPaymentStatus;
    }

    /**
     * @param $objTerminalPaymentStatus
     * @return void
     */
    #[Depends('testItCanSetApprovalID')]
    public function testItCanGetApprovalID($objTerminalPaymentStatus): void
    {
        $this->assertEquals(method_exists($this->objTerminalPaymentStatus, 'getApprovalID'), true);
        $this->assertEquals('testApprovalID', $objTerminalPaymentStatus->getApprovalID());
    }

    /**
     * @return TerminalPaymentStatus
     */
    public function testItCanSetApprovalID(): TerminalPaymentStatus
    {
        $this->assertEquals(method_exists($this->objTerminalPaymentStatus, 'setApprovalID'), true);
        $this->objTerminalPaymentStatus->setApprovalID('testApprovalID');
        return $this->objTerminalPaymentStatus;
    }

    /**
     * @param $objTerminalPaymentStatus
     * @return void
     */
    #[Depends('testItCanSetTicket')]
    public function testItCanGetTicket($objTerminalPaymentStatus): void
    {
        $this->assertEquals(method_exists($this->objTerminalPaymentStatus, 'getTicket'), true);
        $this->assertEquals('testTicket', $objTerminalPaymentStatus->getTicket());
    }

    /**
     * @return TerminalPaymentStatus
     */
    public function testItCanSetTicket(): TerminalPaymentStatus
    {
        $this->assertEquals(method_exists($this->objTerminalPaymentStatus, 'setTicket'), true);
        $this->objTerminalPaymentStatus->setTicket('testTicket');
        return $this->objTerminalPaymentStatus;
    }

    /**
     * @param $objTerminalPaymentStatus
     * @return void
     */
    public function testItCanGetError(): void
    {
        $this->assertEquals(method_exists($this->objTerminalPaymentStatus, 'getError'), true);
    }


    /**
     * @param $objTerminalPaymentStatus
     * @return void
     */
    public function testItCanGetAmount(): void
    {
        $this->assertEquals(method_exists($this->objTerminalPaymentStatus, 'getAmount'), true);
    }


    /**
     * @param $objTerminalPaymentStatus
     * @return void
     */
    #[Depends('testItCanSetIncidentcode')]
    public function testItCanGetIncidentcode($objTerminalPaymentStatus): void
    {
        $this->assertEquals(method_exists($this->objTerminalPaymentStatus, 'getIncidentcode'), true);
        $this->assertEquals('testIncidentcode', $objTerminalPaymentStatus->getIncidentcode());
    }

    /**
     * @return TerminalPaymentStatus
     */
    public function testItCanSetIncidentcode(): TerminalPaymentStatus
    {
        $this->assertEquals(method_exists($this->objTerminalPaymentStatus, 'setIncidentcode'), true);
        $this->objTerminalPaymentStatus->setIncidentcode('testIncidentcode');
        return $this->objTerminalPaymentStatus;
    }

    /**
     * @param $objTerminalPaymentStatus
     * @return void
     */
    #[Depends('testItCanSetIncidentcodetext')]
    public function testItCanGetIncidentcodetext($objTerminalPaymentStatus): void
    {
        $this->assertEquals(method_exists($this->objTerminalPaymentStatus, 'getIncidentcodetext'), true);
        $this->assertEquals('testIncidentcodetext', $objTerminalPaymentStatus->getIncidentcodetext());
    }

    /**
     * @return TerminalPaymentStatus
     */
    public function testItCanSetIncidentcodetext(): TerminalPaymentStatus
    {
        $this->assertEquals(method_exists($this->objTerminalPaymentStatus, 'setIncidentcodetext'), true);
        $this->objTerminalPaymentStatus->setIncidentcodetext('testIncidentcodetext');
        return $this->objTerminalPaymentStatus;
    }

    /**
     * @param $objTerminalPaymentStatus
     * @return void
     */
    public function testItCanGetCancelled(): void
    {
        $this->assertEquals(method_exists($this->objTerminalPaymentStatus, 'getCancelled'), true);
    }


    /**
     * @param $objTerminalPaymentStatus
     * @return void
     */
    public function testItCanGetApproved(): void
    {
        $this->assertEquals(method_exists($this->objTerminalPaymentStatus, 'getApproved'), true);
    }


    /**
     * @param $objTerminalPaymentStatus
     * @return void
     */
    #[Depends('testItCanSetErrormsg')]
    public function testItCanGetErrormsg($objTerminalPaymentStatus): void
    {
        $this->assertEquals(method_exists($this->objTerminalPaymentStatus, 'getErrormsg'), true);
        $this->assertEquals('testErrormsg', $objTerminalPaymentStatus->getErrormsg());
    }

    /**
     * @return TerminalPaymentStatus
     */
    public function testItCanSetErrormsg(): TerminalPaymentStatus
    {
        $this->assertEquals(method_exists($this->objTerminalPaymentStatus, 'setErrormsg'), true);
        $this->objTerminalPaymentStatus->setErrormsg('testErrormsg');
        return $this->objTerminalPaymentStatus;
    }

}