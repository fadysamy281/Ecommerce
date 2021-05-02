<?php

namespace App\Repositories\Contracts;

interface ProductInterface
{
    public function listProducts( $order = 'id',  $sort = 'desc',  $columns = ['*']);
    
    public function store( $params);

    public function update( $params);

    public function findProductBySlug($slug);
    
    public function delete($id);
}
