<?php declare(strict_types=1);
    require_once 'DayThree.php';
    $dayThree = new DayThree;
    print($dayThree->getPartListSum('schematic.txt')."\n");
?>