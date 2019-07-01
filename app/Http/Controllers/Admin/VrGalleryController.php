<?php

namespace App\Http\Controllers\Admin;

use App\VrGallery;
use App\Repositories\VrGalleryRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\VrGalleryRequest;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Input;
use Auth;

class VrGalleryController extends Controller
{

    protected $vrGalleryRepository;

    public function __construct(VrGalleryRepository $vrGalleryRepository){
        $this->vrGalleryRepository = $vrGalleryRepository;
    }

    public function index(){

        $result = $this->vrGalleryRepository->fetchAllWithPaginatorNonSearch(10, self::SORT_ASCENDING);

        return view('admin.vr-gallery.index', [
            'result' => $result,
        ]);
    }

    public function create(){

    }

    public function store(VrGalleryRequest $request){

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

            $user = Auth::user();
            $data['created_by'] = $user->name;

            $result = $this->vrGalleryRepository->store($data);

            if($result){
                return response()->json(['success' => $data]);
            }
        }
    }

    public function update($id){
        if($id === null){
            return redirect()->intended('admin/vr-gallery')
                ->with('message','Bad request');
        }
        $model = $this->vrGalleryRepository->fetchByID($id);
        if($model){
            return view('admin.vr-gallery.update', ['model' => $model]);
        }
        return redirect()->intended('admin/vr-gallery')
            ->with('message','Bad request');
    }
    public function modify(VrGalleryRequest $request){
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

            $user = Auth::user();
            $insertData['updated_by'] = $user->name;

            $result = $this->vrGalleryRepository->update($data['id'], $insertData);
            if($result){
                return redirect()->intended('admin/vr-gallery')
                    ->with('message','Your item has updated successfully!');
            }
        }
    }

    public function remove(Request $request){
        $result = $this->commonSoftDelete($this->vrGalleryRepository, $request->all());
        if($result){
            return response('Deleted', 200);
        }
        return response('Cannot delete', 200);
    }

    public function activate(Request $request){
        $result = $this->commonActivate($this->vrGalleryRepository, $request->all());

        if($result){
            return response('Done', 200);
        }
        return response('Failed', 200);
    }

    public function sort(Request $request){
        $request = $request->all();

        $result = $this->commonSort($this->vrGalleryRepository, $request, 'vr_gallery');
        if($result > 0){
            return response('Done', 200);
        }
        return response('Failed', 200);
    }
}