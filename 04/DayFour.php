<?php declare(strict_types=1);

final class DayFour
{

    public function getScratchcardPoints($filename): int
    {
        return -1;
    }

    public function getScratchCards($filename): int
    {
        $lines = file($filename, FILE_SKIP_EMPTY_LINES | FILE_IGNORE_NEW_LINES);
        $cardScore = 0;

        foreach ($lines as $scratchcard) {
            $lineScore = 0;
            $numberOfMatches = 0;
            $scratchcard = explode(": ", $scratchcard)[1];
            $numbers = explode(' | ', $scratchcard);
            $winningNumbers = preg_split("/\s+/", $numbers[0], -1, PREG_SPLIT_NO_EMPTY);
            $myNumbers = preg_split("/\s+/", $numbers[1], -1, PREG_SPLIT_NO_EMPTY);

            foreach ($myNumbers as $myNumber) {
                if(in_array($myNumber, $winningNumbers)) {
                    $numberOfMatches++;
                }
            }
            if($numberOfMatches > 0) {
                $lineScore = pow(2, $numberOfMatches-1);
            }

            $cardScore += $lineScore;
        }

        return $cardScore;

    }
}
