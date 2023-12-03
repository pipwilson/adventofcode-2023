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

    public function testGetFirstNumberFromMixedString(): void
    {
        $line = "4nineeightseven2";

        $dayOne = new DayOne;
        $firstNumber = $dayOne->getFirstNumberFromLine($line);

        $this->assertEquals(4, $firstNumber);
    }

    public function testGetLastNumberFromMixedString(): void
    {
        $line = "4nineeightseven2";

        $dayOne = new DayOne;
        $lastNumber = $dayOne->getLastNumberFromLine($line);

        $this->assertEquals(2, $lastNumber);
    }

    public function testGetFirstNumberFromLongMixedString(): void
    {
        $line = "oneeighteightseven2";

        $dayOne = new DayOne;
        $firstNumber = $dayOne->getFirstNumberFromLine($line);

        $this->assertEquals(1, $firstNumber);
    }

    public function testGetLastNumberFromLongMixedString(): void
    {
        $line = "oneeighteightseven";

        $dayOne = new DayOne;
        $lastNumber = $dayOne->getLastNumberFromLine($line);

        $this->assertEquals(7, $lastNumber);
    }

    public function testBuildFullNumber1(): void
    {
        $line = "two1nine";
        $dayOne = new DayOne;
        $firstNumber = $dayOne->getFirstNumberFromLine($line);
        $lastNumber = $dayOne->getLastNumberFromLine($line);

        $fullNumber = (int)($firstNumber . $lastNumber);
        $this->assertEquals(29, $fullNumber);
    }

    public function testBuildFullNumber2(): void
    {
        $line = "eightwothree";
        $dayOne = new DayOne;
        $firstNumber = $dayOne->getFirstNumberFromLine($line);
        $lastNumber = $dayOne->getLastNumberFromLine($line);

        $fullNumber = (int)($firstNumber . $lastNumber);
        $this->assertEquals(83, $fullNumber);
    }

    public function testBuildFullNumber3(): void
    {
        $line = "abcone2threexyz";
        $dayOne = new DayOne;
        $firstNumber = $dayOne->getFirstNumberFromLine($line);
        $lastNumber = $dayOne->getLastNumberFromLine($line);

        $fullNumber = (int)($firstNumber . $lastNumber);
        $this->assertEquals(13, $fullNumber);
    }

    public function testBuildFullNumber4(): void
    {
        $line = "xtwone3four";
        $dayOne = new DayOne;
        $firstNumber = $dayOne->getFirstNumberFromLine($line);
        $lastNumber = $dayOne->getLastNumberFromLine($line);

        $fullNumber = (int)($firstNumber . $lastNumber);
        $this->assertEquals(24, $fullNumber);
    }
    
    public function testBuildFullNumber5(): void
    {
        $line = "4nineeightseven2";
        $dayOne = new DayOne;
        $firstNumber = $dayOne->getFirstNumberFromLine($line);
        $lastNumber = $dayOne->getLastNumberFromLine($line);

        $fullNumber = (int)($firstNumber . $lastNumber);
        $this->assertEquals(42, $fullNumber);
    }

    public function testBuildFullNumber6(): void
    {
        $line = "zoneight234";
        $dayOne = new DayOne;
        $firstNumber = $dayOne->getFirstNumberFromLine($line);
        $lastNumber = $dayOne->getLastNumberFromLine($line);

        $fullNumber = (int)($firstNumber . $lastNumber);
        $this->assertEquals(14, $fullNumber);
    }

    public function testBuildFullNumber7(): void
    {
        $line = "7pqrstsixteen";
        $dayOne = new DayOne;
        $firstNumber = $dayOne->getFirstNumberFromLine($line);
        $lastNumber = $dayOne->getLastNumberFromLine($line);

        $fullNumber = (int)($firstNumber . $lastNumber);
        $this->assertEquals(76, $fullNumber);
    }

}