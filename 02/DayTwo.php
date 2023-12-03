<?php declare(strict_types=1);

final class DayTwo
{

    public function getGameId($line): int
    {
        $gameIdPattern = '/Game (\d+)/';
        if (preg_match($gameIdPattern, $line, $matches, PREG_OFFSET_CAPTURE) == 1) {
            $match = $matches[0];
            return (int)$match;
        } else {
            return -1;
        }
    }

    public function getLargestBlueValue($line): int { return -1; }
    public function getLargestRedValue($line): int { return -1; }
    public function getLargestGreenValue($line): int { return -1; }
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
