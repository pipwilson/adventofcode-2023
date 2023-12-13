<?php declare(strict_types=1);
require_once '../phpunit.phar';
require_once 'DayThree.php';

use PHPUnit\Framework\TestCase;

final class DayThreeTestPartTwo extends TestCase
{
    public function testGetAsterices(): void
    {
        $filename = 'example-schematic.txt';
        $dayThree = new DayThree;
        $result = $dayThree->getAsterices($filename);
        print_r($result);
        $this->assertEquals(3, count($result));
    }

    public function testNumberOnLeftOfAsterisk(): void
    {
        $lines = '100*.....';
        $asterix['row'] = 0;
        $asterix['column'] = 3;

        $number['number'] = 100;
        $number['row'] = 0;
        $number['column'] = 0;
        $dayThree = new DayThree;
        $result = $dayThree->isNumberOnLeftOfAsterisk($number, $asterix);
        $this->assertTrue($result);
    }

    public function testNumberNotOnLeftOfAsterisk(): void
    {
        $lines = '100.*....';
        $asterix['row'] = 0;
        $asterix['column'] = 4;

        $number['number'] = 100;
        $number['row'] = 0;
        $number['column'] = 0;
        $dayThree = new DayThree;
        $result = $dayThree->isNumberOnLeftOfAsterisk($number, $asterix);
        $this->assertFalse($result);
    }

    public function testNumberOnLeftOfAsteriskEndOfLine(): void
    {
        $lines = '.....100*';
        $asterix['row'] = 0;
        $asterix['column'] = 8;

        $number['number'] = 100;
        $number['row'] = 0;
        $number['column'] = 5;
        $dayThree = new DayThree;
        $result = $dayThree->isNumberOnLeftOfAsterisk($number, $asterix);
        $this->assertTrue($result);
    }

    public function testSumAllNumbers(): void
    {
        $filename = 'example-schematic.txt';
        $dayThree = new DayThree;
        $result = $dayThree->getGearSum($filename);
        $this->assertEquals(467835, $result);
    }

}