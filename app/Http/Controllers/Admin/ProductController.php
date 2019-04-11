<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Product;
use App\Repositories\Repository;
use App\Http\Controllers\Controller;

class ProductController extends Controller
{
    protected $model;

    public function __construct(Product $product){
        $this->model = new Repository($product);
    }

    public function index(){

    }

    public function create(){

    }

    public function update(){

    }

    public function remove(){

    }

    public function show(){

    }
}
