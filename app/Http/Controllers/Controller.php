<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use App\Helpers\BatchHelper;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    const SORT_ASCENDING = 'asc';
    const SORT_DESCENDING = 'desc';

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

    /**
     * int $currentOrder is order of target row before change
     * int $newOrder is new order, user change at UI
     * @param $activeModel
     * @param $data
     * @param $table
     * @return mixed
     */
    protected function commonSort($activeModel, $data, $table){
        $model = $activeModel->fetchByID($data['id']);
        $currentOrder = $model['sort'];
        $newOrder = $data['sortNo'];
        $impactedModel = $activeModel->fetchByOrder($newOrder);
        $impactedId = 0;
        foreach ($impactedModel as $item) {
            $impactedId = isset($item['id']) ? $item['id'] : 0;
        }
        if($impactedId == 0){
            $updateData = [
                ['id' => (int) $data['id'], 'sort' => (int) $newOrder]
            ];
        }else{
            $updateData = [
                ['id' => (int) $data['id'], 'sort' => (int) $newOrder],
                ['id' => (int) $impactedId, 'sort' => (int) $currentOrder],
            ];
        }

        return $activeModel->sort($updateData, $table);
    }
}
