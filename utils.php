<?php
class Utils
{
    function price_format($number)
    {
        return number_format((float)$number, 2, '.', '');
    }
}
