<?php

namespace App\CheckoutService\Products;

interface ProductsRepoInterface
{
    public function findByCode(string $product_code) : ?array;
}