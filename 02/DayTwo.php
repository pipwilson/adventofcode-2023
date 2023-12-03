<?php declare(strict_types=1);

final class DayTwo
{


    public function convertWordToNumber($word): int
    {
        $mappingArray = [
            'one' => 1,
            'two' => 2,
            'three' => 3,
            'four' => 4,
            'five' => 5,
            'six' => 6,
            'seven' => 7,
            'eight' => 8,
            'nine' => 9,
        ];

        if (array_key_exists($word, $mappingArray)) {
            return $mappingArray[$word];
        } else {
            return -1;
        }
    }

    public function getGameId($line):int { return -1; }
    public function getLargestBlueValue($line):int { return -1; }
    public function getLargestRedValue($line):int { return -1; }
    public function getLargestGreenValue($line):int { return -1; }
    public function valuesAreAllowed($largestBlue, $largestRed, $largestGreen): bool { return false; }

    public function readInputFile(): void
    {
        $lines = file('example-games.txt', FILE_SKIP_EMPTY_LINES);

        $total = 0;

        foreach ($lines as $line) {

            $gameId = $this->getGameId($line);
            $largestBlue = $this->getLargestBlueValue($line);
            $largestRed = $this->getLargestRedValue($line);
            $largestGreen = $this->getLargestGreenValue($line);
            
            if($this->valuesAreAllowed($largestBlue, $largestRed, $largestGreen))
            {
                $total = $total + $gameId;
            }
        }

        print $total;
    }
}
