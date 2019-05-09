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

    public function fetchAllWithPaginator($limit = 10, $criteria = [], $sortType){
        $query = $this->model->whereExists(function($query) use ($criteria){
            $query->select('*')->where('is_deleted' , 0);
            if(!empty($criteria['title'])){
                $query->where('title_vi', 'like', '%' . $criteria['title'] . '%');
                $query->orWhere('title_en', 'like', '%' . $criteria['title'] . '%');
            };

        });
        if($sortType){
            $query->orderBy('sort', $sortType);
        }
        return $query->paginate($limit);
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

    public function sort($data, $table){
        $cases = [];
        $ids = [];
        $params = [];
        foreach ($data as  $row) {
            $id = (int) $row['id'];
            $cases[] = "WHEN {$id} then ?";
            $params[] = $row['sort'];
            $ids[] = $id;
        }
        $ids = implode(',', $ids);
        $cases = implode(' ', $cases);

        return \DB::update("UPDATE `" . $table . "` SET `sort` = CASE `id` {$cases} END
            WHERE `id` in ({$ids})", $params);
    }

    /**
     * @param integer $id
     * @return mixed
     */
    public function fetchByID($id){
        return $this->model::where('is_deleted', '=', 0)->findOrFail($id);
    }

    /**
     * @param $order
     * @return mixed
     */
    public function fetchByOrder($order){
        return $this->model::where(['is_deleted' => 0, 'sort' => $order])->get();
    }
}