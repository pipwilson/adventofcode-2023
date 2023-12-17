<?php declare(strict_types=1);

final class DayFive
{

    public function partOne($filename): void
    {
        $lines = file($filename, FILE_SKIP_EMPTY_LINES | FILE_IGNORE_NEW_LINES);
    }
}
