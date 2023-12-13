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
        $columnToCheck = $number['column']+strlen(''.$number['number']);
        if(strlen(trim(''.$lines[0]))==$columnToCheck) {
            return false;
        }
        return $this->stringContainsSymbol($lines[$number['row']][$columnToCheck]);
    }

    public function hasSymbolAbove($lines, $number): bool
    {
        if($number['row']==0) {
            return false;
        }

        if($number['column'] == 0) {
            $column = 0; 
        } else {
            $column = $number['column']-1;
        } 

        // +2 for the character before and after the string to capture diagonals
        // TODO is there a bug here if the number is at the right and the symbol is only above?
        $stringToCheck = substr(''.$lines[$number['row']-1], $column, strlen(''.$number['number'])+2);
        return $this->stringContainsSymbol($stringToCheck);
    }

    public function hasSymbolBelow($lines, $number): bool
    {
        if(count($lines)==$number['row']+1) {
            return false;
        } 

        if($number['column'] == 0) {
            $column = 0;
            $lengthToCheck = strlen(''.$number['number'])+1;
        } else {
            $column = $number['column']-1;
            $lengthToCheck = strlen(''.$number['number'])+2;
        } 

        $stringToCheck = substr(''.$lines[$number['row']+1], $column, $lengthToCheck);
        // print($stringToCheck."\n");
        return $this->stringContainsSymbol($stringToCheck);

    }

    // given a number at a position, check all around it for a symbol
    public function checkForSymbol($lines, $number): bool
    {
        // print("\nChecking number: ".$number['number']);
        $isSymbolToLeft = $this->hasSymbolOnLeft($lines, $number);
        $isSymbolToRight = $this->hasSymbolOnRight($lines, $number);
        $isSymbolAbove = $this->hasSymbolAbove($lines, $number);
        $isSymbolBelow = $this->hasSymbolBelow($lines, $number);

        // print("\n".$isSymbolToLeft .' | '. $isSymbolToRight .' | '. $isSymbolAbove .' | '. $isSymbolBelow);
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

    public function getAsterices($filename): array
    {
        $asterices = [];

        // we could run the match on the whole file but would need to recalculate position offset based on EOL bytes
        // , so it's just easier to loop each line
        $lines = file($filename, FILE_SKIP_EMPTY_LINES);

        $numberPattern = '/(\*)/';
        for ($row = 0; $row < count($lines); $row++) {
            if(preg_match_all($numberPattern, $lines[$row], $matches, PREG_OFFSET_CAPTURE, 0) > 0) {
                foreach($matches[1] as $match) {
                    $detail['row'] = $row;
                    $detail['column'] = $match[1];
                    $asterices[] = $detail;
                }
            }
        }

        return $asterices;
    }

    public function getNumbersAndLocations($filename): array
    {
        $numbers = [];

         // we could run the match on the whole file but would need to recalculate position offset based on EOL bytes
         // , so it's just easier to loop each line
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

    public function getGearSum($filename): int
    {
        $total = 0;
        //$lines = file($filename, FILE_SKIP_EMPTY_LINES);

        // create an array which only contains numbers
        $numbersAndLocations = $this->getNumbersAndLocations($filename);

        // create an array of every asterisk in the file and its co-ordinates
        $asterices = $this->getAsterices($filename);

        // then loop over asterices and check if it has a number next to it, adding to a match if found
        foreach($asterices as $asterisk) {
            unset($nearbyNumber);
            foreach($numbersAndLocations as $numberWithAsterisk) {
                if($this->isNumberNextToAsterisk($numberWithAsterisk, $asterisk)) {
                    $nearbyNumber[] = $numberWithAsterisk;
                }
            }

            // if there are exactly two numbers around an asterisk then multiply them and add to total
            if(count($nearbyNumber)==2) {
                $total += $nearbyNumber[0]['number'] * $nearbyNumber[1]['number'];
            }
        }

        return $total;
    }

    public function isNumberNextToAsterisk($numberWithAsterisk, $asterisk): bool
    {
        if(in_array($numberWithAsterisk['row'], range($asterisk['row']-1, $asterisk['row']+1))) {
            $isNumberOnLeftOfAsterisk = $this->isNumberOnLeftOfAsterisk($numberWithAsterisk, $asterisk);
            $isNumberOnRightOfAsterisk = $this->isNumberOnRightOfAsterisk($numberWithAsterisk, $asterisk);
            $isNumberAboveAsterisk = $this->isNumberAboveAsterisk($numberWithAsterisk, $asterisk);
            $isNumberBelowAsterisk = $this->isNumberBelowAsterisk($numberWithAsterisk, $asterisk);
            return $isNumberOnLeftOfAsterisk || $isNumberOnRightOfAsterisk || $isNumberAboveAsterisk || $isNumberBelowAsterisk;
        } else {
            return false;
        }
    }

    public function isNumberOnLeftOfAsterisk($numberWithAsterisk, $asterisk): bool
    {
        // if true, asterisk is on same row and starts at the position after the number
        if($asterisk['row'] == $numberWithAsterisk['row']) {
            return $asterisk['column'] == $numberWithAsterisk['column'] + strlen('' . $numberWithAsterisk['number']);
        } else {
            return false;
        }
    }

    private function isNumberOnRightOfAsterisk($numberWithAsterisk, $asterisk): bool
    {
        // if true, asterisk starts at the position after the number
        if($asterisk['row'] == $numberWithAsterisk['row']) {
            return $asterisk['column'] + 1 == $numberWithAsterisk['column'];
        } else {
            return false;
        }
    }

    private function isNumberAboveAsterisk($numberWithAsterisk, $asterisk): bool
    {
        // row of number is row of asterisk-1
        // column of asterisk is within range of start of number to end of number
        if($asterisk['row']-1 == $numberWithAsterisk['row']) {
            for ($i = $asterisk['column'] - 1; $i <= $asterisk['column'] + 1; $i++) {
                if (in_array($i, range($numberWithAsterisk['column'], $numberWithAsterisk['column'] + strlen('' . $numberWithAsterisk['number'])-1))) {
                    return true;
                }
            }
        }

        return false;

    }

    private function isNumberBelowAsterisk($numberWithAsterisk, $asterisk): bool
    {
        if($asterisk['row']+1 == $numberWithAsterisk['row']) {
            for ($i = $asterisk['column'] - 1; $i <= $asterisk['column'] + 1; $i++) {
                if (in_array($i, range($numberWithAsterisk['column'], $numberWithAsterisk['column'] + strlen('' . $numberWithAsterisk['number'])-1))) {
                    return true;
                }
            }
        }

        return false;
    }

}
