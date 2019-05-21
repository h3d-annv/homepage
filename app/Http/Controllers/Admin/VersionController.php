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
    public function store(Request $request)
    {
        $data = $request->all();
        $result = $this->versionRepository->addNew($data);

        $count = @json_encode($result[0], JSON_UNESCAPED_UNICODE);
        if($count === '[]'){
            $vers_new = [$data['version'],$data['version_path']];
            $vers_old = [$data['operation_system_id'],'init','[init]'];
            $logs_result1 = $this->versionRepository->writeLog($vers_new,$vers_old);
            $log1 = @json_encode($logs_result1, JSON_UNESCAPED_UNICODE);
            return response()->json(['success' => $log1]);
            }
            else{
                $vers_new = [$data['version'],$data['version_path']];
                $vers_old = [$data['operation_system_id'],$result[1],$result[2]];
                $logs_result2 = $this->versionRepository->writeLog($vers_new,$vers_old);
                $log2 = @json_encode($logs_result2, JSON_UNESCAPED_UNICODE);
                return response()->json(['success'=>$log2]);
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
    public function update(Request $request, Version $version)
    {
        $data = $request->all();
        $id = $data['id_os'];
        $ver = [$data['version_now'],$data['version_update']];
        $upVer = $this->versionRepository->updated($id,$ver);
        if($upVer){
            $vers_new = [$data['version_update']];
            $vers_old = [$data['id_os'],$data['version_now']];
            $logs_result = $this->versionRepository->writeLog($vers_new,$vers_old);
            $lo = @json_encode($logs_result, JSON_UNESCAPED_UNICODE);
            return response()->json(['success'=>$lo]);
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
