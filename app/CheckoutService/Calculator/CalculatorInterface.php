<?php

namespace App\CheckoutService\Calculator;

interface CalculatorInterface
{
    public static function calcTotal(array $cartProducts, ?array $pricing_rules ) :float;
}
