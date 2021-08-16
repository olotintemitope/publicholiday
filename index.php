<?php

require_once 'vendor/autoload.php';

use LazHoliday\PublicHoliday;

$holiday = new PublicHoliday();

try {

    print_r(
        $holiday->fetch('usa')->getDataForYear(2021)
    );
} catch (Exception $e) {
    var_dump($e->getMessage());
}