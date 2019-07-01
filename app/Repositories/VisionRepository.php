<?php
/**
 * Created by PhpStorm.
 * User: Tài Trần
 * Date: 7/1/2019
 * Time: 2:41 PM
 */

namespace App\Repositories;

use App\Vision;
class VisionRepository extends CommonRepository
{
    public function __construct(Vision $vision) {
        $this->model = $vision;
    }
    public  function  getDataVision($data){
        $data = $this->model->where('id',$data)->get();
//        $dataImg = $data->pluck('image');
        return $data;
    }
}