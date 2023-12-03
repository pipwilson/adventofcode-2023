<?php declare(strict_types=1);
require_once '../phpunit.phar';
require_once 'DayTwo.php';

use PHPUnit\Framework\TestCase;

final class DayTwoTest extends TestCase
{
 
    public function testGetGameId(): void
    {
        $line = "Game 1: 3 blue, 4 red; 1 red, 2 green, 6 blue; 2 green";

        $dayTwo = new DayTwo;
        $gameId = $dayTwo->getGameId($line);

        $this->assertEquals(1, $gameId);
    }

}