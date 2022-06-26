<?php

namespace App\CheckoutService;

use App\CheckoutService\{
    CheckoutServiceInterface,
    Cart\Cart
};

class CheckoutService implements CheckoutServiceInterface
{
    private Cart $cart;
    private array $pricing_rules;

    public function __construct($pricing_rules)
    {
        $this->pricing_rules = $pricing_rules;
        $this->cart = new Cart();
    }

    public function scan($product_code) :void
    {
        $this->cart->addPrdouct($product_code);
    }
    
    public function total() :float
    {
        return $this->cart->getTotal($this->pricing_rules);
    }
}