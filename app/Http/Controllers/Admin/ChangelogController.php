<?php

namespace App\Http\Controllers\Admin;

use App\Changelog;
use App\Repositories\ChangelogRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\ChangelogRequest;
use Auth;

class ChangelogController extends Controller
{
    protected $changelogRepository;

    public function __construct(ChangelogRepository $changelogRepository){
        $this->changelogRepository = $changelogRepository;
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index(){
        $result = $this->changelogRepository->fetchAllWithPaginatorNonSearch(10, self::SORT_ASCENDING);

        return view('admin.changelog.index', [
            'result' => $result,
        ]);
    }

    public function create(){

    }

    public function store(ChangelogRequest $request){

        if($request->validated()){
            $data = $request->all();

            $user = Auth::user();
            $data['created_by'] = $user->name;

            $result = $this->changelogRepository->store($data);

            if($result){
                return response()->json(['success' => $data]);
            }
        }
    }

    public function update($id){
        $changelog=Changelog::findOrFail($id);
        return response()->json(['data'=>$changelog],200);
    }

    public function modify(ChangelogRequest $request){
        if($request->validated()){
            $data = $request->all();
            $insertData = $request->except([ 'id']);

            $user = Auth::user();
            $insertData['updated_by'] = $user->name;

            $result = $this->changelogRepository->update($data['id'], $insertData);
            if($result){
                return response()->json(['success' => $data]);
            }
        }
    }

    public function remove(Request $request){

    }

    public function activate(Request $request){

    }

    public function sort(Request $request){

    }

    public function show($id){

    }
}
