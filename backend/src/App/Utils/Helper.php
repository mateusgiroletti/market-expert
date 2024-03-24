<?php

namespace App\Utils;

class Helper
{
    public static function roundToTwoDecimal(float $number): float
    {
        return round($number, 2);
    }
}
