<?php

require_once 'vendor/autoload.php';

use LazHoliday\PublicHoliday;

try {
    $holiday = new PublicHoliday();
    var_dump($holiday->fetch('us')->getDataForYear(2021));
} catch (\Exception $e) {
    var_dump($e->getMessage());
}