<?php

namespace App\Http\Controllers\admin;

use App\OperationSystem;
use App\Repositories\OperationSystemRepository;
use App\Http\Requests\OperationSystemRequest;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class OperationSystemController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    protected $operationSystemRepository;

    public function __construct(OperationSystemRepository $operationSystemRepository){
        $this->operationSystemRepository = $operationSystemRepository;
    }
    public function index()
    {
        $list_all = $this->operationSystemRepository->showData();
        $list = $list_all[0];
        $list_nover = $list_all[1];
        $user = Auth::user();
        return view('admin/download/operation-system/index',[
            'li'=>$list,
            'lin'=>$list_nover,
            'user' =>$user->name
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
    public function store(OperationSystemRequest $request)
    {
        if($request->validated()){
            $data = $request->all();
            $e = $data['os_name'];
            $equal = $this->operationSystemRepository->equal($e);
            if(count($equal) === 0){
                $result = $this->operationSystemRepository->store($data);
                if($result){
                    return response()->json(['success'=>'Success']);
                }
            }
            else return response()->json(['success'=>"Exits"]);

        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\OperationSystem  $operationSystem
     * @return \Illuminate\Http\Response
     */
    public function show(OperationSystem $operationSystem)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\OperationSystem  $operationSystem
     * @return \Illuminate\Http\Response
     */
    public function edit(OperationSystem $operationSystem)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\OperationSystem  $operationSystem
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, OperationSystem $operationSystem)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\OperationSystem  $operationSystem
     * @return \Illuminate\Http\Response
     */
    public function destroy(OperationSystem $operationSystem)
    {
        //
    }
}
