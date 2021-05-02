<?php

namespace App\Repositories;

use App\Models\Brand;
use App\Traits\FilesTrait;
use App\Repositories\Contracts\BrandInterface;
use App\Repositories\BaseRepository;
use Illuminate\Http\UploadedFile;
use Illuminate\Database\QueryException;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Doctrine\Instantiator\Exception\InvalidArgumentException;

class BrandRepository extends BaseRepository implements BrandInterface
{
    use FilesTrait;
    protected $model;

    public function __construct(Brand $model)
    {
        $this->model = $model;
    }

   
    public function handleBrandRequest($request ,$oldPhoto=null ){
            if(is_null($oldPhoto))
            $request->logo = $this->uploadFile($request->logo , BRANDS_PATH);
            else 
            $request->logo= $this->updateFile($request->logo , BRANDS_PATH , $oldPhoto);    
        
        return $request;
    }
    
    public function listBrands(string $order = 'id', string $sort = 'desc', array $columns = ['*'])
    {
        return $this->all($columns, $order, $sort);
    }


    public function store($request)
    {
        try {
            

            if ($request->has('logo') ) 
                $request = $this->handleBrandRequest($request);
            return $this->create($request);

        } catch (QueryException $exception) {
            throw new InvalidArgumentException($exception->getMessage());
        }
    }

    public function update( $request , $id)
    {
        $brand = $this->findOneOrFail($id);


        if ($collection->has('logo') ) {

            if ($brand && !is_null($brand->logo) ) 
                $request = $this->handleBrandRequest($request , $brand->logo);
            else 
                $request = $this->handleBrandRequest($request );}
        return $this->edit( $request , $id);
    }

    /**
     * @param $id
     * @return bool|mixed
     */
    public function delete($id)
    {
        $brand = $this->findOneOrFail($id);

        if (!is_null($brand->logo) ) {
            $this->deleteFile(BRANDS_PATH , $brand->logo);
        }
        //$brand here is $model
        return $brand->delete();

         
    }

}
