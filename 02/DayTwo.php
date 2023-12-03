<?php declare(strict_types=1);

final class DayTwo
{

    public function getGameId($line): int
    {
        $gameIdPattern = '/Game (\d+)/';
        if (preg_match($gameIdPattern, $line, $matches, PREG_OFFSET_CAPTURE) == 1) {
            $match = $matches[1][0];
            return (int)$match;
        } else {
            return -1;
        }
    }

    public function getLargestColourValue($colour, $line): int
    {
        $colourPattern = '/(\d+) '.$colour.'/';
        if (preg_match_all($colourPattern, $line, $matches, PREG_PATTERN_ORDER) > 0) {
            return (int)max($matches[1]);
        } else {
            return -1;
        }
    }

    public function valuesAreAllowed($largestBlue, $largestRed, $largestGreen): bool 
    { 
        // 12 red cubes, 13 green cubes, and 14 blue cubes
        if($largestBlue <= 14 && $largestRed <= 12 && $largestGreen <= 13) {
            return true;
        } else {
            return false;
        }
    }

    public function readInputFile($filename): int
    {
        $lines = file($filename, FILE_SKIP_EMPTY_LINES);

        $total = 0;

        foreach ($lines as $line) {

            $gameId = $this->getGameId($line);
            $largestBlue = $this->getLargestColourValue('blue', $line);
            $largestRed = $this->getLargestColourValue('red', $line);
            $largestGreen = $this->getLargestColourValue('green', $line);

            if($this->valuesAreAllowed($largestBlue, $largestRed, $largestGreen))
            {
                $total = $total + $gameId;
            }
        }

        return $total;
    }
}
