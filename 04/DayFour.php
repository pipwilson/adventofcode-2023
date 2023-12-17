<?php declare(strict_types=1);

final class DayFour
{

    public function partTwo($filename): void
    {
        $lines = file($filename, FILE_SKIP_EMPTY_LINES | FILE_IGNORE_NEW_LINES);
        $cards = array();
        foreach ($lines as $line) {
            $card["line"] = $line;
            $card["count"] = 1;
            $cards[] = $card;
        }
        unset($card);
        unset($line);

        foreach ($cards as $index=>&$card) {
            for ($i = 0; $i < $card['count']; $i++) {
                $this->processScratchcard($cards, $index,$card);
            }
        }
        unset($card);

        $sum=0;

        foreach($cards as $card) {
            $sum+=$card['count'];
        }

        echo $sum;
    }

    function processScratchcard(&$cards, $index, $card) : void
    {
        $numberOfMatches = $this->processScratchcardLine($card['line']);
        for ($i = 1; $i <= $numberOfMatches; $i++) {
            $cards[$index+$i]['count']++;
        }
    }

    public function getScratchcards($filename): int
    {
        $lines = file($filename, FILE_SKIP_EMPTY_LINES | FILE_IGNORE_NEW_LINES);
        $cardScore = 0;

        foreach ($lines as $scratchcard) {
            $lineScore = 0;
            $numberOfMatches = $this->processScratchcardLine($scratchcard);
            if($numberOfMatches > 0) {
                $lineScore = pow(2, $numberOfMatches-1);
            }

            $cardScore += $lineScore;
        }

        return $cardScore;

    }

    public function processScratchcardLine($scratchcard): int
    {

        $numberOfMatches = 0;
        $scratchcard = explode(": ", $scratchcard)[1];
        $numbers = explode(' | ', $scratchcard);
        $winningNumbers = preg_split("/\s+/", $numbers[0], -1, PREG_SPLIT_NO_EMPTY);
        $myNumbers = preg_split("/\s+/", $numbers[1], -1, PREG_SPLIT_NO_EMPTY);

        foreach ($myNumbers as $myNumber) {
            if (in_array($myNumber, $winningNumbers)) {
                $numberOfMatches++;
            }
        }
        return $numberOfMatches;
    }
}
