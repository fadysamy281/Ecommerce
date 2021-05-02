<?php

namespace App\Repositories\Contracts;

interface AttributeInterface
{

    public function listAttributes( $order = 'id',  $sort = 'desc', $columns = ['*']);

    public function handleAttributeRequest( $request);
    public function store( $request);
    public function update( $request , $id);


}
