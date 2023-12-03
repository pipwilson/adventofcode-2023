<?php

declare(strict_types=1);

final class DayOne
{

    public function getFirstNumberFromLine($line): int
    {
        $firstNumberPattern = "(one|two|three|four|five|six|seven|eight|nine|\d)";
        if (preg_match($firstNumberPattern, $line, $matches) == 1) {
            $match = $matches[0];
            return $this->convertMatch($match);
        } else {
            return -1;
        }
    }

    public function getLastNumberFromLine($line): int
    {
        $lastNumberPattern = "/(?=(one|two|three|four|five|six|seven|eight|nine|\d))/";
        if (preg_match_all($lastNumberPattern, $line, $matches) > 0) {
            $match = $matches[1][count($matches[0]) - 1];
            return $this->convertMatch($match);
        } else {
            return -1;
        }
    }

    public function convertMatch($match): int
    {
        // regex matches are always strings, so we have to use is_numeric and cast, rather than is_int
        if (is_numeric($match)) {
            return (int)$match;
        } else if (is_string($match)) {
            return $this->convertWordToNumber($match);
        }
    }

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

    public function readCalibrationFile(): void
    {
        $lines = file('calibrationValues.txt', FILE_SKIP_EMPTY_LINES);

        $total = 0;

        foreach ($lines as $line) {

            $firstValue = $this->getFirstNumberFromLine($line);
            $lastValue = $this->getLastNumberFromLine($line);
            if ($firstValue < 0 || $lastValue < 0) {
                exit('Did not find the values in line: ' . $line);
            } else {
                $calibrationValue = (int)($firstValue . $lastValue);
                $total = $total + $calibrationValue;
            }
        }

        print $total;
    }
}
