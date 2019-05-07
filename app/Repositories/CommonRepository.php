<?php

namespace App\Repositories;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Pagination\Paginator;

class CommonRepository
{
    public $model;

    function __construct(Model $model){
        $this->model = $model;
    }

    public function fetchAllWithPaginator(int $limit = 10, $criteria = []){
        return $this->model->where('is_deleted' , 0)->whereExists(function($query) use ($criteria){

            if(!empty($criteria['title'])){
                $query->where('title_vi', 'like', '%' . $criteria['title'] . '%');
                $query->orWhere('title_en', 'like', '%' . $criteria['title'] . '%');
            };

        })->paginate($limit);
    }

    /**
     * Create a new record in the database
     * @param array $data
     * @return mixed
     */
    public function store($data = []) {
        return $this->model->create($data);
    }

    /**
     * Update a record in the database
     * @param array $data
     * @return mixed
     */
    public function update($id, $data = []) {
        return $this->model::where(['id' => $id])->update($data);
    }

    /**
     * @param integer $id
     * @return mixed
     */
    public function fetchByID($id){
        return $this->model::where('is_deleted', '=', 0)->findOrFail($id);
    }
}