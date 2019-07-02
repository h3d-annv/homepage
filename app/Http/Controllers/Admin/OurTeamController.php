<?php

namespace App\Http\Controllers\admin;

use App\OurTeam;
use App\Repositories\OurTeamRepository;
use App\Http\Requests\OurTeamRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class OurTeamController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    protected $ourTeamRepository;

    public function __construct(OurTeamRepository $ourTeamRepository)
    {
        $this->ourTeamRepository = $ourTeamRepository;
    }

    public function index()
    {
        $user = Auth::user();
        $teams = OurTeam::all()->where('is_deleted',0);
        return view('admin/about-us/our-team/index',[
            'current_user' => $user->name,
            'teams' => $teams
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
    public function store(OurTeamRequest $request)
    {
        if ($request->validated()) {
            $data = $request->all();
//
            $newImageName = null;
            // Check if request contains image
            if ($request->hasFile('image')) {
                $image = $request->file('image');
                $extension = $image->clientExtension();
                $newImageName = md5(microtime() . $image->getClientOriginalName()) . '.' . $extension;
                Storage::disk('public')->put($newImageName, File::get($image));
            }
            $data['image'] = $newImageName;
            $result = $this->ourTeamRepository->store($data);
            $a = @json_encode($result, JSON_UNESCAPED_UNICODE);
//
            if ($result) {
                return response()->json(['success' => $a]);
            }

        }
    }
    /**
     * Display the specified resource.
     *
     * @param  \App\OurTeam  $ourTeam
     * @return \Illuminate\Http\Response
     */
    public function show(OurTeam $ourTeam)
    {
        //
    }
    public function modify(Request $request){
        $rules =[
            'name'    =>  'required|max:50',
            'roll_vi'     =>  'required|max:255',
            'roll_en'     =>  'required|max:255',
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
        $result = $this->ourTeamRepository->update($data['id'], $insertData);
        if($result){
            return response()->json(['success'=>"Done"]);
        }
    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\OurTeam  $ourTeam
     * @return \Illuminate\Http\Response
     */
    public function edit(OurTeam $ourTeam)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\OurTeam  $ourTeam
     * @return \Illuminate\Http\Response
     */
    public function getData(Request $request){
        $input = $request->all();
        $result = $this->ourTeamRepository->getDataTeam($input);
        $a = @json_encode($result,JSON_UNESCAPED_UNICODE);
        if($result){
            return response()->json(['success'=>$a]);
        }
    }
    public function update(Request $request, OurTeam $ourTeam)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\OurTeam  $ourTeam
     * @return \Illuminate\Http\Response
     */
    public function destroy(OurTeam $ourTeam)
    {
        //
    }
    public function remove(Request $request){
        $result = $this->commonSoftDelete($this->ourTeamRepository, $request->all());
        if($result){
            return response('Deleted', 200);
        }
        return response('Cannot delete', 200);
    }
    public function activate(Request $request){
        $result = $this->commonActivate($this->ourTeamRepository, $request->all());
        if($result){
            return response('Done', 200);
        }
        return response('Failed', 200);
    }
    public function sort(Request $request){
        $request = $request->all();

        $result = $this->commonSort($this->ourTeamRepository, $request, 'our_teams');
        if($result > 0){
            return response('Done', 200);
        }
        return response('Failed', 200);
    }
}
