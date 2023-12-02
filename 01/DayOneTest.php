<?php declare(strict_types=1);
require_once '../phpunit.phar';
require_once 'DayOne.php';

use PHPUnit\Framework\TestCase;

final class DayOneTest extends TestCase
{
    public function testGetFirstNumberFromLine(): void
    {
        $line = "XX322";

        $dayOne = new DayOne;
        $firstNumber = $dayOne->getFirstNumberFromLine($line);

        $this->assertEquals(3, $firstNumber);
    }

    public function testGetLastNumberFromLine(): void
    {
        $line = "XX322dd";

        $dayOne = new DayOne;
        $lastNumber = $dayOne->getLastNumberFromLine($line);

        $this->assertEquals(2, $lastNumber);
    }

    public function testGetFirstNumberFromLineSingleNumber(): void
    {
        $line = "7b";

        $dayOne = new DayOne;
        $firstNumber = $dayOne->getFirstNumberFromLine($line);

        $this->assertEquals(7, $firstNumber);
    }

    public function testGetLastNumberFromLineSingleNumber(): void
    {
        $line = "7b";

        $dayOne = new DayOne;
        $lastNumber = $dayOne->getLastNumberFromLine($line);

        $this->assertEquals(7, $lastNumber);
    }

}