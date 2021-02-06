<?php

namespace NiagahosterTest\Util;

class Index
{
    static function formatCurrency($number, $symbol = "Rp")
    {
        $result = number_format($number, 2, ',', '.');

        if (!empty($symbol)) {
            return "$symbol " . number_format($number, 0, '', '.');
        }

        return $result;
    }
}
