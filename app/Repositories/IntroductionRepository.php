<?php
/**
 * Created by PhpStorm.
 * User: Tài Trần
 * Date: 5/28/2019
 * Time: 11:48 AM
 */

namespace App\Repositories;
use App\Introduction;

class IntroductionRepository extends CommonRepository
{
    public function __construct(Introduction $introduction) {
    $this->model = $introduction;
    }
    public  function  getDataIntro($data){
        $data = $this->model->where('id',$data)->get();
        return $data;
    }
    public function addNewIntro($data){
        $this->store($data);
    }
}