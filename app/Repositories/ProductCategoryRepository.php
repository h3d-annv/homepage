<?php

namespace App\Repositories;

use App\ProductCategory;

class ProductCategoryRepository extends CommonRepository
{
    public function __construct(ProductCategory $productCategory) {
        $this->model = $productCategory;
    }
}