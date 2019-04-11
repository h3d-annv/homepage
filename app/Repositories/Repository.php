<?php

namespace App\Repositories;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Pagination\Paginator;
use App\ProductCategory;

class Repository implements RepositoryInterface
{
    // model property on class instances
    protected $model;

    // Constructor to bind model to repo
    public function __construct(Model $model)
    {
        $this->model = $model;
    }

    // Get all instances of model
    public function all(int $limit = 10, $seachCriteria = []){

        $title = $seachCriteria['title'];

        return $this->model->whereExists(function($query) use ($title){

            $query->where('is_deleted' , 0);

            if(!empty($title)){
                $query->where('title_vi', 'like', '%' . $title . '%');
                $query->orWhere('title_en', 'like', '%' . $title . '%');
            };

        })->paginate($limit);
    }

    /**
     * Create a new record in the database
     * @param array $data
     * @return mixed
     */
    public function search(array $criteria, int $limit)
    {
        $query = $this->model::where('is_deleted', '=', 0);
        $query->orWhere($criteria);
        return $query->paginate(10);
    }

    /**
     * Create a new record in the database
     * @param array $data
     * @return mixed
     */
    public function store(array $data)
    {
        return $this->model->create($data);
    }

    /**
     * Update record in the database
     * @param $id
     * @param array $data
     * @return mixed
     */
    public function modify($id, array $data)
    {
        $record = $this->find($id);
        return $record->update($data);
    }

    /**
     * Remove record from the database
     * @param $id
     * @return int
     */
    public function destroy($id)
    {
        return $this->model->destroy($id);
    }

    /**
     * Soft delete record in the database
     * Update is_deleted = 1 for selected row
     * @param $id
     * @param array $data
     * @return mixed
     */
    public function soft($id, array $data)
    {
        $record = $this->find($id);
        return $record->update($data);
    }

    /**
     * Active or de-active for selected row
     * 0: de-active
     * 1: active
     * @param $id
     * @param array $data
     * @return mixed
     */
    public function workflow($id, array $data)
    {
        $record = $this->find($id);
        return $record->update($data);
    }

    /**
     * Show the record with the given id for
     * @param $id
     * @return Model
     */
    public function single($id)
    {
        return $this->model-findOrFail($id);
    }

    // Get the associated model
    public function getModel()
    {
        return $this->model;
    }

    // Set the associated model
    public function setModel($model)
    {
        $this->model = $model;
        return $this;
    }

    // Eager load database relationships
    public function with($relations)
    {
        return $this->model->with($relations);
    }
}