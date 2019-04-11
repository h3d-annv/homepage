<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\ProductCategory;
use App\Repositories\Repository;
use App\Http\Controllers\Controller;
use App\Http\Requests\ProductCategoryRequest;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;
use App\Helpers\StringHelper;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Input;

class ProductCategoryController extends Controller
{
    protected $model;

    public function __construct(ProductCategory $productCategory){
        $this->model = new Repository($productCategory);
    }

    public function index(){
        $searchCriteria = [
            'title' => Input::get('title'),
            'category_id' => Input::get('category_id')
        ];

        $productCategory = $this->model->all(3, $searchCriteria);

        $productCategory->setPath('product-category?title=' . $searchCriteria['title'] . '&category_id=' . $searchCriteria['category_id']);
        return view('admin/product-category/index', [
            'result' => $productCategory,
            'title' => $searchCriteria['title'],
        ]);
    }

    public function create(){
        return view('admin/product-category/create', []);
    }

    public function store(ProductCategoryRequest $request){

        if($request->validated()){
            $data = $request->all();

            $newImageName = null;
            // Check if request contains image
            if($request->hasFile('image')){
                $image = $request->file('image');
                $extension = $image->clientExtension();
                $newImageName = md5(microtime() . $image->getClientOriginalName()) . '.' . $extension;
                Storage::disk('public')->put($newImageName,  File::get($image));
            }

            // Build unique slug
            $table = $this->model->getModel()->getTable();
            $data['image'] = $newImageName;
            $slug = str_slug($data['title_en']);
            $data['slug'] = StringHelper::buildUniqueSlug($table, 0, $slug);

            $result = $this->model->store($data);

            if($result){
                return redirect()->intended('admin/product-category')
                    ->with('message','Your item has created successfully!');
            }
        }
        return redirect()->intended('admin/product-category')
            ->with('message','FAIL!');
    }

    public function update(){

    }

    public function modify(){

    }

    public function remove(){

    }

    public function show(){

    }

    /**
     * Search state from database base on some specific constraints
     *
     * @param  \Illuminate\Http\Request  $request
     *  @return \Illuminate\Http\Response
     */
    public function search(ProductCategoryRequest $request){
        $constraint = [
            'name' => $request['name']
        ];
        $criteria = [
            ['title_vi', 'like', '%' . $request['name'] . '%'],
            ['title_en', 'like', '%' . $request['name'] . '%'],
        ];
        $result = $this->model->search($criteria, 5);

        return view('admin/product-category/index', ['result' => $result, 'searchingVals' => $constraint]);
    }
}
