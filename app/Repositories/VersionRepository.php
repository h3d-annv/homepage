<?php
/**
 * Created by PhpStorm.
 * User: Tài Trần
 * Date: 5/18/2019
 * Time: 2:49 PM
 */

namespace App\Repositories;
use App\Version;
use Illuminate\Database\Eloquent\Collection;
class VersionRepository extends CommonRepository
{
    public function __construct(Version $version) {
        $this->model = $version;
    }
    //update version
    public function  updated($id, $ver ){
        $this->model->where('operation_system_id',$id)->where('is_active',1)->update(['is_active'=>'0']);
        $this->model->where('operation_system_id',$id)->where('version',$ver)->update(['is_active'=>'1']);
        $ver_path_new =  $this->model->where('operation_system_id',$id)->where('is_active',1)->pluck('version_path');
        return $ver_path_new;
    }
    //Add new version
    public function addNew($data){
        $ver = $this->model->where('operation_system_id',$data['operation_system_id'])->where('is_active',1);
        $ver_old = $ver->pluck('version');
        $ver_path_old = $ver->pluck('version_path');

        $this->model->where('operation_system_id',$data['operation_system_id'])->where('is_active',1)->update(['is_active'=>'0']);
        $this->store($data);
        return [$ver_old,$ver_path_old];
    }
    public function createLog($dataLog,$data_ver){
            $count = $this->model->where('operation_system_id',$dataLog['operation_system_id'])->pluck('version');
            $time = $this->model->where('operation_system_id',$dataLog['operation_system_id'])->where('is_active',1)->pluck('updated_at');
            if(count($count) === 1){
               $firstLog = [
                   'operation_system_id'=>$dataLog['operation_system_id'],
                   'time'=>$time,
                   'version_old'=>'init',
                   'version_path_old'=>'init',
                   'version_new'=>$dataLog['version'],
                   'version_path_new'=>$dataLog['version_path'],
                   'updated_by'=>$dataLog['created_by']
               ];
               return $firstLog;
            }
            else{
               $log = [
                   'operation_system_id'=>$dataLog['operation_system_id'],
                   'time'=>$time,
                   'version_old'=>$data_ver[0],
                   'version_path_old'=>$data_ver[1],
                   'version_new'=>$dataLog['version'],
                   'version_path_new'=>$dataLog['version_path'],
                   'updated_by'=>$dataLog['created_by']
               ];
               return $log;
            }
    }
    //log
    public function writeLog($vers_new=[],$vers_old = []){
        if(count($vers_new) === 1){
            $vers_path_old = $this->model->where('operation_system_id',$vers_old[0])->where('version',$vers_old[1])->pluck('version_path');
            $vers_path_new = $this->model->where('operation_system_id',$vers_old[0])->where('version',$vers_new[0])->pluck('version_path');
            $time_update = $this->model->where('operation_system_id',$vers_old[0])->where('version',$vers_new[0])->pluck('updated_at');
            $logs = [$vers_old[0],$time_update,$vers_old[1],$vers_path_old,$vers_new[0],$vers_path_new];
        }
       else{
           $time_update = $this->model->where('operation_system_id',$vers_old[0])->where('version',$vers_new[0])->pluck('updated_at');
            $logs = [$vers_old[0],$time_update,$vers_old[1],$vers_old[2],$vers_new[0],$vers_new[1]];
       }
        return $logs;
    }
}