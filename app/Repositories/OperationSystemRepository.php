<?php
/**
 * Created by PhpStorm.
 * User: Tài Trần
 * Date: 5/18/2019
 * Time: 2:49 PM
 */

namespace App\Repositories;
use App\OperationSystem;

class OperationSystemRepository extends CommonRepository
{
    public function __construct(OperationSystem $operationSystem) {
        $this->model = $operationSystem;
    }
    public function showData(){
        $list = $this->model->has('versions')->get();
        $list_nover = $this->model->doesntHave('versions')->get();
//        $list = $this->model->all();
        return [$list,$list_nover];
    }

    public function update($osn, $ver = []){
        $ver1 = $ver[1];
        return $this->model->where('os_name',$osn)->get();
    }
}