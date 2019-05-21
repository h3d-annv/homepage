<?php
/**
 * Created by PhpStorm.
 * User: Tài Trần
 * Date: 5/20/2019
 * Time: 12:38 AM
 */

namespace App\Repositories;
use App\Log;
class LogRepository extends CommonRepository
{
    public function __construct(Log $log) {
        $this->model = $log;
    }
    public function showLog($id){
        return $this->model->where('operation_system_id',$id)->get();
    }
}