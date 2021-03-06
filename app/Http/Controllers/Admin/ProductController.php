<?php

namespace App\Http\Controllers\Admin;

use App\Product;
use App\ProductCategory;
use App\Repositories\ProductRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\ProductRequest;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;
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

        $categories = ProductCategory::all();

        return view('admin/product/index', [
            'result' => $result,
            'title' => $searchCriteria['title'],
            'categories' => $categories,
        ]);
    }

    public function create(){
        $categories = ProductCategory::select('id', 'title_en')->get();
//        dd($categories);
        return view('admin.product.create', ['categories' => $categories]);
    }

    public function store(ProductRequest $request){

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
            $data['image'] = $newImageName;

            $result = $this->productRepository->store($data);

            if($result){
                return redirect()->intended('admin/product')
                    ->with('message','Your item has created successfully!');
            }
        }
        return redirect()->intended('admin/product')
            ->with('message','FAIL!');
    }

    public function update($id){
        if($id === null){
            return redirect()->intended('admin/product')
                ->with('message','Bad request');
        }

        $model = $this->productRepository->fetchByID($id);
        $categories = ProductCategory::select('id', 'title_en')->get();
        $current_category = ProductCategory::select('title_en')->where('id', $model->category_id)->value('title_en');

        if($model){
            return view('admin.product.update', ['model' => $model, 'categories' => $categories, 'current_category' => $current_category]);
        }
        return redirect()->intended('admin/product')
            ->with('message','Bad request');
    }

    public function modify(ProductRequest $request){
        if($request->validated()){
            $data = $request->all();
            $insertData = $request->except(['_token', '_method', 'id', 'currentImage', 'currentSlug']);

            // Check if request contains image
            if($request->hasFile('image')){
                $path = public_path() . '/uploads/';
                $currentImage = $path . $data['currentImage'];
                if( chmod($path, 0777) ) {
                    if(is_file($currentImage)){
                        unlink($currentImage);
                    }
                    chmod($path, 0755);
                }
                $image = $request->file('image');
                $extension = $image->clientExtension();
                $newImageName = md5(microtime() . $image->getClientOriginalName()) . '.' . $extension;
                Storage::disk('public')->put($newImageName,  File::get($image));

                $insertData['image'] = $newImageName;
            }

            $result = $this->productRepository->update($data['id'], $insertData);
            if($result){
                return redirect()->intended('admin/product')
                    ->with('message','Your item has updated successfully!');
            }
        }
    }


    public function remove(Request $request){
        $result = $this->commonSoftDelete($this->productRepository, $request->all());
        if($result){
            return response('Deleted', 200);
        }
        return response('Cannot delete', 200);
    }

    public function activate(Request $request){
        $result = $this->commonActivate($this->productRepository, $request->all());
        if($result){
            return response('Done', 200);
        }
        return response('Failed', 200);
    }

    public function sort(Request $request){
        $request = $request->all();

        $result = $this->commonSort($this->productRepository, $request, 'product');
        if($result > 0){
            return response('Done', 200);
        }
        return response('Failed', 200);
    }

    public function show($id){
        $product = Product::find($id);
        return view('product.show')->with('product', $product);
    }
}
