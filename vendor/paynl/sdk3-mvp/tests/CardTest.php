<?php

declare(strict_types=1);

use PHPUnit\Framework\Attributes\Depends;
use PHPUnit\Framework\TestCase;
use PayNL\Sdk\Model\Card;

/**
 * Class CardTest
 */
final class CardTest extends TestCase
{
    /**
     * @var Card
     */
    protected $objCard;

    /**
     * @return void
     */
    public function setUp(): void
    {
        $this->objCard = new Card();
    }

    /**
     * @param $objCard
     * @return void
     */
    #[Depends('testItCanSetId')]
    public function testItCanGetId($objCard): void
    {
        $this->assertEquals(method_exists($this->objCard, 'getId'), true);
        $this->assertEquals('testId', $objCard->getId());
    }

    /**
     * @return Card
     */
    public function testItCanSetId(): Card
    {
        $this->assertEquals(method_exists($this->objCard, 'setId'), true);
        $this->objCard->setId('testId');
        return $this->objCard;
    }

    /**
     * @param $objCard
     * @return void
     */
    #[Depends('testItCanSetName')]
    public function testItCanGetName($objCard): void
    {
        $this->assertEquals(method_exists($this->objCard, 'getName'), true);
        $this->assertEquals('testName', $objCard->getName());
    }

    /**
     * @return Card
     */
    public function testItCanSetName(): Card
    {
        $this->assertEquals(method_exists($this->objCard, 'setName'), true);
        $this->objCard->setName('testName');
        return $this->objCard;
    }

}