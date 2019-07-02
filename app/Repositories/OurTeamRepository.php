<?php
/**
 * Created by PhpStorm.
 * User: Tài Trần
 * Date: 7/1/2019
 * Time: 4:12 PM
 */

namespace App\Repositories;

use App\OurTeam;
class OurTeamRepository extends  CommonRepository
{
    public function __construct(OurTeam $ourTeam) {
        $this->model = $ourTeam;
    }
    public  function  getDataTeam($data){
        $data = $this->model->where('id',$data)->get();
        return $data;
    }
}