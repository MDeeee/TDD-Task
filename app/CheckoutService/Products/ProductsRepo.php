<?php

namespace App\CheckoutService\Products;

use App\CheckoutService\{
    Traits\FindInArrayTrait,
    Products\ProductsRepoInterface
};

class ProductsRepo implements ProductsRepoInterface
{
    use FindInArrayTrait;
    
    protected array $products;

    public function __construct()
    {
        $this->products = [
            ["code" => "CF1", "name" => "Cofee", "price" => 11.23],
            ["code" => "FR1", "name" => "Fruit Tea", "price" => 3.11],
            ["code" => "SR1", "name" => "Strawberry", "price" => 5.00],
        ];
    }

    public function findByCode(string $product_code) : ?array
    {
        return $this->find_by_code($this->products, $product_code);
    }
    
}