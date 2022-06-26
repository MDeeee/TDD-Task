<?php

namespace App\CheckoutService\Traits;

trait FindInArrayTrait
{
    protected static function find_by_code(array $array, string $code)
    {
        $index = array_search($code, array_column($array, "code"));
        return $index !== false ? $array[$index] : null;
    }
}