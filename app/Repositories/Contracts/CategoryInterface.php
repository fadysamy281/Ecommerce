<?php

namespace App\Repositories\Contracts;

interface CategoryInterface
{

    public function listCategories( $order = 'id',  $sort = 'desc',  $columns = ['*']);

    public function handleCategoryRequest($request , $oldPhoto = null);
    public function store( $request);

    public function update( $request , $id);

    
    //return bool     
    public function delete($id);
    public function treeList();// using AestallableCollection Package
    public function findBySlug($slug);

}
