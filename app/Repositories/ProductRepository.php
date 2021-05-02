<?php

namespace App\Repositories;

use App\Models\Product;
use App\Traits\FilesTrait;
use App\Repositories\BaseRepository;
use App\Repositories\Contracts\ProductInterface;

use Illuminate\Http\UploadedFile;
use Illuminate\Database\QueryException;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Doctrine\Instantiator\Exception\InvalidArgumentException;


class ProductRepository extends BaseRepository implements ProductInterface
{
    use FilesTrait;

    protected $model;
    public function __construct(Product $model)
    {
        $this->model = $model;
    }

    public function listProducts( $order = 'id',  $sort = 'desc',  $columns = ['*'])
    {
        return $this->all($columns, $order, $sort);
    }


    public function findProductById( $id)
    {
        try {
            return $this->findOneOrFail($id);

        } catch (ModelNotFoundException $e) {

            throw new ModelNotFoundException($e);
        }

    }

    public function handleProductRequest($request){
        $featured = $request->has('featured') ? 1 : 0;
        $status = $request->has('status') ? 1 : 0;
        $arr= array([
            'featured'=>$featured,
            'status'  =>$status
        ]);
        $request->merge($arr);
        return $request;
    }
    public function store($request)
    {
        try {

            $request = handleProductRequest($request);
            return $product = $this->create($request);


            if ($collection->has('categories')) {
                $product->categories()->sync($request->categories);
            }
            return $product;

        } catch (QueryException $exception) {
            throw new InvalidArgumentException($exception->getMessage());
        }
    }

    public function update( $request , $id)
    {
        $request = handleProductRequest($request , $id);

        $product = $this->edit($request , $id);

        if ($request->has('categories')) {
            $product->categories()->sync($request->categories);
        }

        return $product;
    }

    public function findProductBySlug($slug)
    {
        return $product = Product::where('slug', $slug)->first();

    }    
}
