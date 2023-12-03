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

        $this->assertEquals(1, $gameId);
    }


    
}