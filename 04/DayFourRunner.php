<?php declare(strict_types=1);
    require_once 'DayFour.php';
    $dayFour = new DayFour;
    print($dayFour->getScratchcardPoints('scratchcard.txt')."\n");
?>