<?php

namespace App\CheckoutService\Cart;

interface CartInterface 
{
    public function addPrdouct(string $product_code) :void;
       
    public function getTotal(?array $pricing_rules) :float;
}