<?php declare(strict_types=1);

final class DayOne
{
    
    public function getFirstNumberFromLine($line): int
    {
        $firstNumberPattern = "(\d)";
        if (preg_match($firstNumberPattern, $line, $matches) == 1) {
            return (int)$matches[0];
        } else {
            return -1;
        }
    }

    public function getLastNumberFromLine($line): int
    {
        $lastNumberPattern = "/(\d)/";
        if (preg_match_all($lastNumberPattern, $line, $matches) > 0) {
            return (int)$matches[0][count($matches[0])-1];
        } else {
            return -1;
        }
    }

    public function readCalibrationFile(): void
    {
        $lines = file('calibrationValues.txt', FILE_SKIP_EMPTY_LINES|FILE_IGNORE_NEW_LINES);

        $total = 0;
        
        foreach($lines as $line) {
              
            $firstValue = $this->getFirstNumberFromLine($line);
            $lastValue = $this->getLastNumberFromLine($line);
            if($firstValue < 0 || $lastValue < 0) {
                exit('Did not find the values in line: '.$line);
            } else {
                $calibrationValue = (int)($firstValue.$lastValue);
                $total = $total + $calibrationValue;
            }
        }

        print $total;
        
    }

}
