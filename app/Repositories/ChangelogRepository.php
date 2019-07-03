<?php

namespace App\Repositories;

use App\Changelog;

class ChangelogRepository extends CommonRepository
{
    public function __construct(Changelog $changelog) {
        $this->model = $changelog;
    }

    public function fetchByID($id){
        return $this->model::findOrFail($id);
    }

    public function fetchAllWithPaginatorNonSearch($limit = 10, $sortType = false){
        $query = $this->model->whereExists(function($query) {
            $query->select('*');
        });
        if($sortType){
            $query->orderBy('id', $sortType);
        }
        return $query->paginate($limit);
    }
}
