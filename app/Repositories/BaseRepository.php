<?php

namespace App\Repositories;
use App\Repositories\Contracts\BaseRepositoryInterface;

class BaseRepository implements BaseRepositoryInterface
{
    protected $model;

    public function __construct(Model $model)
    {
        $this->model = $model;
    }
    
    public function findOneOrFail( $id)
    {
        return $this->model->findOrFail($id);
    }
    public function create( $request)
    {
        return $this->model->create($request->validated());
    }

    public function edit( $request,  $id)
    {//returned result from findOneOrFail() is $model
        return $this->findOneOrFail($id)->update($request->validated());
    }

    public function index($columns = array('*'),  $orderBy = 'id',  $sortBy = 'asc')
    {
        return $this->model->orderBy($orderBy, $sortBy)->get($columns);
    }

    public function find( $id)
    {
        return $this->model->find($id);
    }



    public function findBy( $data)
    {
        return $this->model->where($data)->all();
    }

    public function findOneBy( $data)
    {
        return $this->model->where($data)->first();
    }

    public function findOneByOrFail( $data)
    {
        return $this->model->where($data)->firstOrFail();
    }

    public function delete($id)
    {
        return $this->findOneOrFail($id)->delete();
    }
}
