<?php declare(strict_types=1);
require_once '../phpunit.phar';
require_once 'DayThree.php';

use PHPUnit\Framework\TestCase;

final class DayThreeTest extends TestCase
{
    public function testSumAllNumbers(): void
    {
        $filename = 'example-schematic.txt';
        $dayThree = new DayThree;
        $result = $dayThree->sumAllNumbers($filename);
        $this->assertEquals(4533, $result);
    }
    
    public function testFindNumbersAndLocations(): void
    {
        $filename = 'example-schematic.txt';
        $dayThree = new DayThree;
        $line = '467..114..';
        $result = $dayThree->getNumbersAndLocations($filename);
        $this->assertEquals(10, sizeof($result));
    }

    public function testHasSymbolOnLeft(): void
    {
        $lines = ['...$123..'];
        $detail['number'] = 123;
        $detail['row'] = 0;
        $detail['column'] = 4;
        $dayThree = new DayThree;
        $result = $dayThree->hasSymbolOnLeft($lines, $detail);
        $this->assertTrue($result);
    }

    public function testHasSymbolOnLeftNoSymbol(): void
    {
        $lines = ['...123..'];
        $detail['number'] = 123;
        $detail['row'] = 0;
        $detail['column'] = 4;
        $dayThree = new DayThree;
        $result = $dayThree->hasSymbolOnLeft($lines, $detail);
        $this->assertFalse($result);
    }

    public function testHasSymbolOnLeftAtColumnZero(): void
    {
        $lines = ['123...$123..'];
        $detail['number'] = 123;
        $detail['row'] = 0;
        $detail['column'] = 0;
        $dayThree = new DayThree;
        $result = $dayThree->hasSymbolOnLeft($lines, $detail);
        $this->assertFalse($result);
    }

    public function testHasSymbolAboveFail(): void
    {
        $lines = ['123...123..',
                  '123...789..'];
        $detail['number'] = 789;
        $detail['row'] = 1;
        $detail['column'] = 7;
        $dayThree = new DayThree;
        $result = $dayThree->hasSymbolAbove($lines, $detail);
        $this->assertFalse($result);
    }

    public function testHasSymbolAboveFail2(): void
    {
        $lines = ['123.$.123..',
                  '123...789..'];
        $detail['number'] = 789;
        $detail['row'] = 1;
        $detail['column'] = 7;
        $dayThree = new DayThree;
        $result = $dayThree->hasSymbolAbove($lines, $detail);
        $this->assertFalse($result);
    }

    public function testHasSymbolAbovePass(): void
    {
        $lines = ['123..$12da',
                  '123...789..'];
        $detail['number'] = 789;
        $detail['row'] = 1;
        $detail['column'] = 6;
        $dayThree = new DayThree;
        $result = $dayThree->hasSymbolAbove($lines, $detail);
        $this->assertTrue($result);
    }

    public function testHasSymbolAbovePass2(): void
    {
        $lines = ['123.$$123..',
                  '123...789..'];
        $detail['number'] = 789;
        $detail['row'] = 1;
        $detail['column'] = 6;
        $dayThree = new DayThree;
        $result = $dayThree->hasSymbolAbove($lines, $detail);
        $this->assertTrue($result);
    }

    public function testHasSymbolAbovePass3(): void
    {
        $lines = ['123...123$.',
                  '123...789..'];
        $detail['number'] = 789;
        $detail['row'] = 1;
        $detail['column'] = 6;
        $dayThree = new DayThree;
        $result = $dayThree->hasSymbolAbove($lines, $detail);
        $this->assertTrue($result);
    }

    public function testHasSymbolBelowPass1(): void
    {
        $lines = ['467..114..',
                  '...*......'];
        $detail['number'] = 467;
        $detail['row'] = 0;
        $detail['column'] = 0;
        $dayThree = new DayThree;
        $result = $dayThree->hasSymbolBelow($lines, $detail);
        $this->assertTrue($result);
    }

    public function testGetPartListSum(): void
    {
        $dayThree = new DayThree;
        $result = $dayThree->getPartListSum('example-schematic.txt');
        $this->assertEquals(4361, $result);
    }
}