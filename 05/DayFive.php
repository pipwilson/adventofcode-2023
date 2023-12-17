<?php declare(strict_types=1);

final class DayFive
{
    var array $maps = array();
    var array $seeds = array();

    public function partOne($filename): void
    {
        $lines = file($filename, FILE_SKIP_EMPTY_LINES | FILE_IGNORE_NEW_LINES);
        preg_match_all("/(\d+)/", $lines[0], $matches);
        $this->seeds = $matches[0];
        $this->getMaps($lines);
        for ($i = 0; $i < sizeof($this->seeds); $i++) {
            // we know the name of the input and output so could loop this instead probably
            $soil = $this->getNextValue($this->seeds[$i], $this->maps['seed-to-soil']);
            $fertilizer = $this->getNextValue($soil, $this->maps['soil-to-fertilizer']);
            $water = $this->getNextValue($fertilizer, $this->maps['fertilizer-to-water']);
            $light = $this->getNextValue($water, $this->maps['water-to-light']);
            $temperature = $this->getNextValue($light, $this->maps['light-to-temperature']);
            $humidity = $this->getNextValue($temperature, $this->maps['temperature-to-humidity']);
            $location = $this->getNextValue($humidity, $this->maps['humidity-to-location']);
            $locations[] = $location;
        }

        print(min($locations));
    }

    // loop over every line, storing values in an array and using textual lines as a map delimiter
    private function getMaps(array $lines): void
    {
        $currentMapName = 'unassigned';
        for ($i = 1; $i < sizeof($lines); $i++) {
            if(str_ends_with($lines[$i], ':')) {
                $currentMapName = rtrim($lines[$i], ' map:');
            } else {
                $lineComponents = preg_split("/[ ]+/", $lines[$i]);
                $row['destination'] = $lineComponents[0];
                $row['source'] = $lineComponents[1];
                $row['range'] = $lineComponents[2];
                $this->maps[$currentMapName][] = $row;
            }
        }
    }

    private function getNextValue($needle, $map): int
    {
        for ($i = 0; $i < sizeof($map); $i++) {
            if($needle >= $map[$i]['source'] && $needle < $map[$i]['source']+$map[$i]['range']) {
                return intval($map[$i]['destination'] += ($needle - $map[$i]['source']));
            }
        }
        return intval($needle);
    }
}
