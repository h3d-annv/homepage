<?php

namespace App\Http\Controllers\admin;

use App\Version;
use App\Repositories\VersionRepository;
use App\Http\Requests\VersionRequest;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class VersionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    protected $versionRepository;

    public function __construct(VersionRepository $versionRepository){
        $this->versionRepository = $versionRepository;
    }
    public function index()
    {
        //
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
    public function store(VersionRequest $request)
    {
        if($request->validated()){
            $data = $request->all();
            $dataLog = $request->except(['updated_by','description']);
            $result = $this->versionRepository->addNew($data);

            $log = $this->versionRepository->createLog($dataLog,$result);

            $c = @json_encode($log, JSON_UNESCAPED_UNICODE);

            return response()->json(['success'=>$c]);

        }

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Version  $version
     * @return \Illuminate\Http\Response
     */
    public function show(Version $version)
    {
        //
    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Version  $version
     * @return \Illuminate\Http\Response
     */
    public function edit(Version $version)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Version  $version
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $data = $request->all();
        $id = $data['operation_system_id'];
        $ver = $data['version'];
        $result = $this->versionRepository->updated($id,$ver);
        if($result){
            $dataLog = [
              'operation_system_id' => $data['operation_system_id'],
              'version'=>$data['version'],
              'version_path'=>$result,
              'created_by'=>$data['created_by']
            ];
            $log = $this->versionRepository->createLog($dataLog,[$data['version_now'],$data['version_old_path']]);
            $c = @json_encode($log, JSON_UNESCAPED_UNICODE);

            return response()->json(['success'=>$c]);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Version  $version
     * @return \Illuminate\Http\Response
     */
    public function destroy(Version $version)
    {
        //
    }
}
