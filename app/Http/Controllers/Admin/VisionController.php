<?php

namespace App\Http\Controllers\admin;

use App\Vision;
use App\Repositories\VisionRepository;
use App\Http\Requests\VisionRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class VisionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    protected $visionRepository;

    public function __construct(VisionRepository $visionRepository)
    {
        $this->visionRepository = $visionRepository;
    }
    public function index()
    {
        $user = Auth::user();
        $vision =Vision::all()->where('is_deleted',0);
        return view('admin/about-us/vision/index',[
            'current_user' => $user->name,
            'visions' => $vision
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(VisionRequest $request)
    {
        if($request->validated()){
            $data = $request->all();
//
            $newImageName = null;
            // Check if request contains image
            if($request->hasFile('icon')){
                $image = $request->file('icon');
                $extension = $image->clientExtension();
                $newImageName = md5(microtime() . $image->getClientOriginalName()) . '.' . $extension;
                Storage::disk('public')->put($newImageName,  File::get($image));
            }
            $data['icon'] = $newImageName;
            $result = $this->visionRepository->store($data);
            $a = @json_encode($result, JSON_UNESCAPED_UNICODE);
//
            if($result){
                return response()->json(['success'=>$a]);
            }

        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Vision  $vision
     * @return \Illuminate\Http\Response
     */
    public function show(Vision $vision)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Vision  $vision
     * @return \Illuminate\Http\Response
     */
    public function edit(Vision $vision)
    {
        //
    }
    public function modify(Request $request){
        $rules =[
            'title_vi'    =>  'required|max:255',
            'title_en'     =>  'required|max:255',
            'icon'         =>  'image|mimes:jpeg,png,jpg,gif,svg,ico|max:10000'
        ];
        $error = Validator::make($request->all(), $rules);
        if($error->fails())
        {
            return response()->json(['errors' => $error->errors()->all()]);
        }
        $data = $request->all();
        $insertData = $request->except(['current_icon']);
        if($request->hasFile('icon')) {
            $path = public_path() . '/uploads/';
            $currentImage = $path . $data['current_icon'];
            if( chmod($path, 0777) ) {
                if(is_file($currentImage)){
                    unlink($currentImage);
                }
                chmod($path, 0755);
            }
            $image = $request->file('icon');
            $extension = $image->clientExtension();
            $newImageName = md5(microtime() . $image->getClientOriginalName()) . '.' . $extension;
            Storage::disk('public')->put($newImageName,  File::get($image));

            $insertData['icon'] = $newImageName;
//                $a = @json_encode($insertData, JSON_UNESCAPED_UNICODE);
        }
        $result = $this->visionRepository->update($data['id'], $insertData);
        if($result){
            return response()->json(['success'=>"Done"]);
        }
    }
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Vision  $vision
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {

    }
    public function getData(Request $request){
        $input = $request->all();
        $result = $this->visionRepository->getDataVision($input);
        $a = @json_encode($result,JSON_UNESCAPED_UNICODE);
        if($result){
            return response()->json(['success'=>$a]);
        }
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Vision  $vision
     * @return \Illuminate\Http\Response
     */
    public function remove(Request $request){
        $result = $this->commonSoftDelete($this->visionRepository, $request->all());
        if($result){
            return response('Deleted', 200);
        }
        return response('Cannot delete', 200);
    }
    public function activate(Request $request){
        $result = $this->commonActivate($this->visionRepository, $request->all());
        if($result){
            return response('Done', 200);
        }
        return response('Failed', 200);
    }
    public function sort(Request $request){
        $request = $request->all();

        $result = $this->commonSort($this->visionRepository, $request, 'introductions');
        if($result > 0){
            return response('Done', 200);
        }
        return response('Failed', 200);
    }
    public function destroy(Vision $vision)
    {
        //
    }
}
