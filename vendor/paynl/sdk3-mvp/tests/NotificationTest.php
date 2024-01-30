<?php

declare(strict_types=1);

use PHPUnit\Framework\Attributes\Depends;
use PHPUnit\Framework\TestCase;
use PayNL\Sdk\Model\Notification;

/**
 * Class NotificationTest
 */
final class NotificationTest extends TestCase
{
    /**
     * @var Notification
     */
    protected $objNotification;

    /**
     * @return void
     */
    public function setUp(): void
    {
        $this->objNotification = new Notification();
    }

    /**
     * @return Notification
     */
    public function testItCanSetType(): Notification
    {
        $this->assertEquals(method_exists($this->objNotification, 'setType'), true);
        $this->objNotification->setType('testType');
        return $this->objNotification;
    }

    /**
     * @param $objNotification
     * @return void
     */
    #[Depends('testItCanSetType')]
    public function testItCanGetType($objNotification): void
    {
        $this->assertEquals(method_exists($this->objNotification, 'getType'), true);
        $this->assertEquals('testType', $objNotification->getType());
    }

    /**
     * @return Notification
     */
    public function testItCanSetRecipient(): Notification
    {
        $this->assertEquals(method_exists($this->objNotification, 'setRecipient'), true);
        $this->objNotification->setRecipient('testRecipient');
        return $this->objNotification;
    }

    /**
     * @param $objNotification
     * @return void
     */
    #[Depends('testItCanSetRecipient')]
    public function testItCanGetRecipient($objNotification): void
    {
        $this->assertEquals(method_exists($this->objNotification, 'getRecipient'), true);
        $this->assertEquals('testRecipient', $objNotification->getRecipient());
    }

}