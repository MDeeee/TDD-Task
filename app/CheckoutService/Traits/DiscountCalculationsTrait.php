<?php

namespace App\CheckoutService\Traits;

trait DiscountCalculationsTrait {

    protected static function get_one_free(array $product, array $discount) :float
    {
        return (floor($product['qty'] / $discount['qty']) + ($product['qty'] % $discount['qty'])) * $product['price'];
    }

    protected static function bulk_purchase(array $product, array $discount) :float
    {
        return $product['qty'] >= $discount['qty'] ? $product['qty'] * $discount['price'] : $product['qty'] * $product['price'];
    }
}