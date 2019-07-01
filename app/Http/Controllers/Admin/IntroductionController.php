<?php

namespace App\Http\Controllers\admin;

use App\Introduction;
use App\Repositories\IntroductionRepository;
use App\Http\Requests\IntroductionRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;


class IntroductionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    protected $introductionRepository;

    public function __construct(IntroductionRepository $introductionRepository)
    {
        $this->introductionRepository = $introductionRepository;
    }

    public function index()
    {
        $user = Auth::user();
        $intro = Introduction::all()->where('is_deleted',0);
        return view('admin/about-us/intro/index',[
            'current_user' => $user->name,
            'intros' => $intro
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
    public function store(IntroductionRequest $request)
    {
        if($request->validated()){
            $data = $request->all();
//
            $newImageName = null;
            // Check if request contains image
            if($request->hasFile('image')){
                $image = $request->file('image');
                $extension = $image->clientExtension();
                $newImageName = md5(microtime() . $image->getClientOriginalName()) . '.' . $extension;
                Storage::disk('public')->put($newImageName,  File::get($image));
            }
            $data['image'] = $newImageName;
            $result = $this->introductionRepository->store($data);
            $a = @json_encode($result, JSON_UNESCAPED_UNICODE);
//
            if($result){
                return response()->json(['success'=>$a]);
            }

        }

    }
    public function modify(Request $request){
        $rules =[
            'title_vi'    =>  'required|max:255',
            'title_en'     =>  'required|max:255',
            'image'         =>  'image|mimes:jpeg,png,jpg,gif,svg|max:10000'
        ];
        $error = Validator::make($request->all(), $rules);
        if($error->fails())
        {
            return response()->json(['errors' => $error->errors()->all()]);
        }
        $data = $request->all();
        $insertData = $request->except(['current_image']);
        if($request->hasFile('image')) {
            $path = public_path() . '/uploads/';
            $currentImage = $path . $data['current_image'];
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
//                $a = @json_encode($insertData, JSON_UNESCAPED_UNICODE);
        }
        $result = $this->introductionRepository->update($data['id'], $insertData);
        if($result){
            return response()->json(['success'=>"Done"]);
        }
    }
    /**
     * Display the specified resource.
     *
     * @param  \App\Introduction  $introduct
     * @return \Illuminate\Http\Response
     */
    public function show(Introduction $introduction)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Introduction  $introduct
     * @return \Illuminate\Http\Response
     */
    public function edit(Introduction $introduction)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Introduction  $introduct
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {

    }
    public function getData(Request $request){
        $input = $request->all();
        $result = $this->introductionRepository->getDataIntro($input);
        $a = @json_encode($result,JSON_UNESCAPED_UNICODE);
        if($result){
            return response()->json(['success'=>$a]);
        }
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Introduction  $introduct
     * @return \Illuminate\Http\Response
     */
    public function remove(Request $request){
        $result = $this->commonSoftDelete($this->introductionRepository, $request->all());
        if($result){
            return response('Deleted', 200);
        }
        return response('Cannot delete', 200);
    }
    public function activate(Request $request){
        $result = $this->commonActivate($this->introductionRepository, $request->all());
        if($result){
            return response('Done', 200);
        }
        return response('Failed', 200);
    }
    public function sort(Request $request){
        $request = $request->all();

        $result = $this->commonSort($this->introductionRepository, $request, 'introductions');
        if($result > 0){
            return response('Done', 200);
        }
        return response('Failed', 200);
    }
}
