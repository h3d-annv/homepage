<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Product;
use App\Repositories\Repository;
use App\Http\Controllers\Controller;
use App\Repositories\ProductRepository;
use Illuminate\Support\Facades\Input;

class ProductController extends Controller
{
    protected $productRepository;

    public function __construct(ProductRepository $productRepository){
        $this->productRepository = $productRepository;
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index(){
        $searchCriteria = [
            'title' => Input::get('title'),
            'category_id' => Input::get('category_id')
        ];

        $result = $this->productRepository->fetchAllWithPaginator(10, $searchCriteria);

        $result->setPath('product?title=' . $searchCriteria['title'] . '&category_id=' . $searchCriteria['category_id']);
        return view('admin/product/index', [
            'result' => $result,
            'title' => $searchCriteria['title'],
        ]);
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
