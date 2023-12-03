<?php declare(strict_types=1);
require_once '../phpunit.phar';
require_once 'DayTwo.php';

use PHPUnit\Framework\TestCase;

final class DayTwoTest extends TestCase
{
 
    public function testGetGameId(): void
    {
        $line = "Game 99: 6 red, 1 blue, 3 green; 2 blue, 1 red, 2 green";

        $dayTwo = new DayTwo;
        $gameId = $dayTwo->getGameId($line);

        $this->assertEquals(99, $gameId);
    }

    public function testGetLargestBlueValue(): void
    {
        $line = "Game 3: 8 green, 6 blue, 20 red; 5 blue, 4 red, 13 green; 5 green, 1 red";

        $dayTwo = new DayTwo;
        $gameId = $dayTwo->getLargestColourValue('blue', $line);

        $this->assertEquals(6, $gameId);
    }

    public function testGetLargestRedValue(): void
    {
        $line = "Game 3: 8 green, 6 blue, 20 red; 5 blue, 4 red, 13 green; 5 green, 1 red";

        $dayTwo = new DayTwo;
        $gameId = $dayTwo->getLargestColourValue('red', $line);

        $this->assertEquals(20, $gameId);
    }

    public function testGetLargestGreenValue(): void
    {
        $line = "Game 3: 8 green, 6 blue, 20 red; 5 blue, 4 red, 13 green; 5 green, 1 red";

        $dayTwo = new DayTwo;
        $gameId = $dayTwo->getLargestColourValue('green', $line);

        $this->assertEquals(13, $gameId);
    }

    public function testReadInputFile(): void
    {
        $dayTwo = new DayTwo;
        $total = $dayTwo->readInputFile('example-games.txt');

        $this->assertEquals(8, $total);
    }

    public function testReadInputFilePartTwo(): void
    {
        $dayTwo = new DayTwo;
        $total = $dayTwo->readInputFilePartTwo('example-games.txt');

        $this->assertEquals(2286, $total);
    }

}