<?php

namespace App\Repositories\Contracts;

interface BaseRepositoryInterface
{

    public function create($attributes);

    public function update($attributes, $id);

    public function all($columns = array(['*']),
         $orderBy = 'id', $sortBy = 'desc');

    public function find($id);

    public function findOneOrFail($id);

    public function findBy($data);

    public function findOneBy($data);

    public function findOneByOrFail($data);

    public function delete($id);
}
