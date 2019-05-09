<?php

namespace App\Http\Controllers\Admin;

use App\Repositories\ProductCategoryRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\ProductCategoryRequest;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;
use App\Helpers\StringHelper;
use Illuminate\Support\Facades\Input;

class ProductCategoryController extends Controller
{
    protected $productCategoryRepository;

    public function __construct(ProductCategoryRepository $productCategoryRepository){
        $this->productCategoryRepository = $productCategoryRepository;
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index(){
        $searchCriteria = [
            'title' => Input::get('title'),
            'category_id' => Input::get('category_id')
        ];

        $result = $this->productCategoryRepository->fetchAllWithPaginator(10, $searchCriteria, self::SORT_ASCENDING);

        $result->setPath('product-category?title=' . $searchCriteria['title'] . '&category_id=' . $searchCriteria['category_id']);
        return view('admin/product-category/index', [
            'result' => $result,
            'title' => $searchCriteria['title'],
        ]);
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create(){
        return view('admin/product-category/create', []);
    }

    /**
     * @param ProductCategoryRequest $request
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
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
            $data['image'] = $newImageName;

            // Build unique slug
            $slug = str_slug($data['title_en']);
            $data['slug'] = StringHelper::buildUniqueSlug('product_category', 0, $slug);

            $result = $this->productCategoryRepository->store($data);

            if($result){
                return redirect()->intended('admin/product-category')
                    ->with('message','Your item has created successfully!');
            }
        }
        return redirect()->intended('admin/product-category')
            ->with('message','FAIL!');
    }

    /**
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Http\RedirectResponse|\Illuminate\View\View
     */
    public function update($id){
        if($id === null){
            return redirect()->intended('admin/product-category')
                ->with('message','Bad request');
        }

        $model = $this->productCategoryRepository->fetchByID($id);
        if($model){
            return view('admin.product-category.update', ['model' => $model]);
        }
        return redirect()->intended('admin/product-category')
            ->with('message','Bad request');
    }

    /**
     * @param ProductCategoryRequest $request
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function modify(ProductCategoryRequest $request){
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

            if($data['slug'] !== $data['currentSlug']){
                // Build unique slug
                $slug = str_slug($data['title_en']);
                $insertData['slug'] = StringHelper::buildUniqueSlug('product_category', 0, $slug);
            }

            $result = $this->productCategoryRepository->update($data['id'], $insertData);
            if($result){
                return redirect()->intended('admin/product-category')
                    ->with('message','Your item has created successfully!');
            }
        }
    }

    /**
     * @param Request $request
     * @return \Illuminate\Contracts\Routing\ResponseFactory|\Illuminate\Http\Response
     */
    public function remove(Request $request){
        $result = $this->commonSoftDelete($this->productCategoryRepository, $request->all());
        if($result){
            return response('Deleted', 200);
        }
        return response('Cannot delete', 200);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Contracts\Routing\ResponseFactory|\Illuminate\Http\Response
     */
    public function activate(Request $request){
        $result = $this->commonActivate($this->productCategoryRepository, $request->all());
        if($result){
            return response('Done', 200);
        }
        return response('Failed', 200);
    }

    public function sort(Request $request){
        $request = $request->all();

        $result = $this->commonSort($this->productCategoryRepository, $request, 'product_category');
        if($result > 0){
            return response('Done', 200);
        }
        return response('Failed', 200);
    }

    public function show(){

    }
}
