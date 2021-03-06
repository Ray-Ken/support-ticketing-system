<?php
declare(strict_types=1);

namespace Ticket\Tests\Domain\Ticket;

use Ticket\Tests\Support\TestCase;
use Ticket\Tests\Support\MotherObject\Domain\Ticket\TicketTitleMother;

class TicketTitleTest extends TestCase
{
    public function testParseToString_HaveValidTitle_ReturnedStringHasExpectedValue(): void
    {
        // arrange
        $expectedTitleAsString = 'Lorem ipsum dolor sit amet...';
        $title = TicketTitleMother::create($expectedTitleAsString);

        // act
        $titleAsString = (string)$title;

        // assert
        $this->assertSame($expectedTitleAsString, $titleAsString);
    }

    public function testParseToString_HaveMinLengthTitle_ReturnedStringHasExpectedValue(): void
    {
        // arrange
        $expectedTitleAsString = 'ą';
        $title = TicketTitleMother::create($expectedTitleAsString);

        // act
        $titleAsString = (string)$title;

        // assert
        $this->assertSame($expectedTitleAsString, $titleAsString);
    }

    public function testParseToString_HaveMaxLengthTitle_ReturnedStringHasExpectedValue(): void
    {
        // arrange
        $expectedTitleAsString = str_repeat('ą', 255);
        $title = TicketTitleMother::create($expectedTitleAsString);

        // act
        $titleAsString = (string)$title;

        // assert
        $this->assertSame($expectedTitleAsString, $titleAsString);
    }

    public function testCreation_HaveTooShortTitle_ThrownException(): void
    {
        // arrange
        $invalidTitle = '';

        // assert
        $this->expectException(\InvalidArgumentException::class);

        // act
        TicketTitleMother::create($invalidTitle);
    }

    public function testCreation_HaveTooLongTitle_ThrownException(): void
    {
        // arrange
        $invalidTitle = str_repeat('ą', 256);

        // assert
        $this->expectException(\InvalidArgumentException::class);

        // act
        TicketTitleMother::create($invalidTitle);
    }

    public function testEquals_HaveTwoSameTitles_ReturnsTrue(): void
    {
        // arrange
        $titleOne = TicketTitleMother::create('Same title');
        $titleTwo = TicketTitleMother::create('Same title');

        // act
        $equals = $titleOne->equals($titleTwo);

        // assert
        $this->assertTrue($equals);
    }

    public function testEquals_HaveTwoDifferentNames_ReturnsFalse(): void
    {
        // arrange
        $titleOne = TicketTitleMother::create('Title one');
        $titleTwo = TicketTitleMother::create('Title two');

        // act
        $equals = $titleOne->equals($titleTwo);

        // assert
        $this->assertFalse($equals);
    }
}