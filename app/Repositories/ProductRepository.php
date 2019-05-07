<?php

namespace App\Repositories;

use App\Product;

class ProductRepository extends CommonRepository
{
    public function __construct(Product $product) {
        $this->model = $product;
    }
}