<?php

namespace App\Repositories;

use App\VrGallery;

class VrGalleryRepository extends CommonRepository
{
    public function __construct(VrGallery $vrGallery) {
        $this->model = $vrGallery;
    }

    public function fetchAllWithPaginatorNonSearch($limit = 10, $sortType = false){
        $query = $this->model->whereExists(function($query) {
            $query->select('*')->where('is_deleted' , 0);
        });
        if($sortType){
            $query->orderBy('sort', $sortType);
        }
        return $query->paginate($limit);
    }
}