<?php

namespace App\Repositories\Contracts;

interface BrandInterface
{

    public function listBrands( $order = 'id',  $sort = 'desc',  $columns = ['*']);

    public function handleBrandRequest($request ,$oldPhoto );

    public function store( $request);

    public function update( $request);

    
    //return bool     
    public function delete($id);

}
