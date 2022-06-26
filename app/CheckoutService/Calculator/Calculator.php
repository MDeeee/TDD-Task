<?php

namespace App\CheckoutService\Calculator;

use App\CheckoutService\{
    Calculator\CalculatorInterface,
    Traits\FindInArrayTrait,
    Traits\DiscountCalculationsTrait
};

class Calculator implements CalculatorInterface
{
    use DiscountCalculationsTrait, FindInArrayTrait;

    public static function calcTotal(array $cartProducts, array $pricing_rules = null) :float
    {
        $total = 0;
        
        if (count($cartProducts) > 0) {

            foreach ($cartProducts as $product) {

                $discount = $pricing_rules ? self::getDiscount($product['code'], $pricing_rules) : null;

                if ($discount) {

                    $total += self::getTotalItemWithDiscount($product, $discount);

                } else {

                    $total += self::getTotalItem($product);
                }
            }
        }

        return $total;
    }

    private static function getDiscount(string $product_code, array $pricing_rules) :?array
    {
        return self::find_by_code($pricing_rules, $product_code);
    }
    
    private static function getTotalItemWithDiscount(array $product, array $discount) :float
    {
        if (!method_exists(self::class, $discount['function_name'])) {

            throw new \ErrorException('The discount function does not found');

        } else {
            
            return self::{$discount['function_name']}($product, $discount);
        }

        return 0;
    }

    private static function getTotalItem($product) :float
    {
        return (int) $product['qty'] * (float) $product['price'];
    }
}
