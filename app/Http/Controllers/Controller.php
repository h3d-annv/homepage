<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    /**
     * Soft delete single record
     * Set is_deleted = 1
     * @param $activeModel
     * @param $data
     * @return bool
     */
    protected function commonSoftDelete($activeModel, $data){
        $model = $activeModel->fetchByID($data['id']);
        if($model){
            $result = $activeModel->update($data['id'], ['is_deleted' => 1]);
            if($result){
                return true;
            }
        }
        return false;
    }

    /**
     * Active or de-active single record
     * If current is_active = 1 => set it to 0
     * If current is_active = 0 => set it to 1
     * @param $activeModel
     * @param $data
     * @return bool
     */
    protected function commonActivate($activeModel, $data){
        $model = $activeModel->fetchByID($data['id']);
        if($model){
            $result = $activeModel->update($data['id'], ['is_active' => ($data['status'] == 0) ? 1 : 0]);
            if($result){
                return true;
            }
        }
        return false;
    }
}
