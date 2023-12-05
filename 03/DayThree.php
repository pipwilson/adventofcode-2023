<?php declare(strict_types=1);

final class DayThree
{



    public function hasSymbolOnLeft($lines, $number): bool
    {
        if($number['column'] == 0) {
            return false;
        } else {
            return $this->stringContainsSymbol($lines[$number['row']][$number['column']-1]);
        }
    }

    public function hasSymbolOnRight($lines, $number): bool
    {
        $columnToCheck = $number['column']+strlen(''.$number['column'])+2;
        if(strlen($lines[0])==$columnToCheck) {
            return false;
        }
        return $this->stringContainsSymbol($lines[$number['row']][$columnToCheck]);
    }

    public function hasSymbolAbove($lines, $number): bool
    {
        if($number['row']==0) {
            return false;
        }
        // +2 for the character before and after the string to capture diagonals
        $stringToCheck = substr(''.$lines[$number['row']-1], $number['column']-1, strlen(''.$number['number'])+2);
        return $this->stringContainsSymbol($stringToCheck);
    }

    public function hasSymbolBelow($lines, $number): bool
    {
        if(count($lines)==$number['row']+1) {
            return false;
        } else {
            $number['column'] == 0? $column = 0  : $column = $number['column']-1;
            $stringToCheck = substr($lines[$number['row']+1], $column, strlen(''.$number['number'])+2);
            return $this->stringContainsSymbol($stringToCheck);
        }
    }

    // given a number at a position, check all around it for a symbol
    public function checkForSymbol($lines, $number): bool
    {
        // print("\nChecking number: ".$number['number']);
        $isSymbolToLeft = $this->hasSymbolOnLeft($lines, $number);
        $isSymbolToRight = $this->hasSymbolOnRight($lines, $number);
        $isSymbolAbove = $this->hasSymbolAbove($lines, $number);
        $isSymbolBelow = $this->hasSymbolBelow($lines, $number);

        return $isSymbolToLeft || $isSymbolToRight || $isSymbolAbove || $isSymbolBelow;
    }

    public function stringContainsSymbol($string): bool
    {
        $symbolPattern = '([^.\d\s]+)';
        if(preg_match($symbolPattern, $string, $matches) == 1) {
            return true;
        }

        return false;
    }

    public function getNumbersAndLocations($filename): array
    {
        $numbers = [];

         // we could run the match on the whole file but would need to recalculate position offset based on EOL bytes
         // so it's just easier to loop each line
        $lines = file($filename, FILE_SKIP_EMPTY_LINES);

        $numberPattern = '/(\d+)/';
        for ($row = 0; $row < count($lines); $row++) {
            if(preg_match_all($numberPattern, $lines[$row], $matches, PREG_OFFSET_CAPTURE, 0) > 0) {
                foreach($matches[1] as $match) {
                    $detail['number'] = $match[0];
                    $detail['row'] = $row;
                    $detail['column'] = $match[1];
                    $numbers[] = $detail;
                }
            }
        }

        return $numbers;
    }

    public function getPartListSum($filename): int
    {
        $total = 0;
        $lines = file($filename, FILE_SKIP_EMPTY_LINES);
        $numbersAndLocations = $this->getNumbersAndLocations($filename);
        foreach($numbersAndLocations as $number) {
            if($this->checkForSymbol($lines, $number)) {
                $total += $number['number'];
            }
        }
        return $total;
    }

    // maybe we can sum all numbers and then subtract the ones which don't have a symbol nearby?
    public function sumAllNumbers($filename): int
    {
        $schematic = file_get_contents($filename);
        $numberPattern = '/(\d+)/';
        if (preg_match_all($numberPattern, $schematic, $matches) > 0) {
            return array_sum($matches[0]);
        }
        return -1;
    }

}
