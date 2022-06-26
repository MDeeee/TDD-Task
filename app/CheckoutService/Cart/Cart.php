<?php

namespace App\CheckoutService\Cart;

use App\CheckoutService\{
    Cart\CartInterface,
    Traits\FindInArrayTrait,
    Products\ProductsRepo,
    Calculator\Calculator,
};

class Cart implements CartInterface
{
    use FindInArrayTrait;
    
    protected ProductsRepo $products_repo;
    protected array $cart;

    public function __construct()
    {
        $this->products_repo = new ProductsRepo;
        $this->cart = [];
    }

    public function addPrdouct($product_code) :void
    {
        $productInCart = $this->find_by_code($this->cart, $product_code);

        if($productInCart) $this->incrementItem($productInCart);

        else $this->addItem($product_code);
    }

    private function incrementItem($productInCart) :void
    {
        $index = array_search($productInCart['code'], array_column($this->cart, 'code'));
        
        if ($index !== false) $this->cart[$index]['qty']++;
    }

    private function addItem($product_code) :void
    {
        $product = $this->products_repo->findByCode($product_code);

        if ($product) {
            $this->cart[] = [
                "code" => $product['code'],
                "price" => $product['price'],
                "qty" => 1 
            ];
        }
    }

    public function getTotal(array $pricing_rules = null) :float
    {
        return Calculator::calcTotal($this->cart, $pricing_rules);
    }
}