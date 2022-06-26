<?php

namespace App\CheckoutService;

interface CheckoutServiceInterface
{
    public function scan($product_code) :void;

    public function total() :float;

}