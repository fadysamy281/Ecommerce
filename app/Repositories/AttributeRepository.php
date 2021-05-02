<?php
namespace App\Repositories;

use App\Models\Attribute;
use App\Repositories\Contracts\AttributeInterface;
use App\Repositories\BaseRepository;

use Illuminate\Database\QueryException;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Doctrine\Instantiator\Exception\InvalidArgumentException;

class AttributeRepository extends BaseRepository implements AttributeInterface
{
    protected $model;
    public function __construct(Attribute $model)
    {
        $this->model = $model;
    }

    public function listAttributes( $order = 'id',  $sort = 'desc',  $columns = ['*'])
    {
        return $this->index($columns, $order, $sort);
    }

    public function findAttributeById( $id)
    {
        try {
            return $this->findOneOrFail($id);

        } catch (ModelNotFoundException $e) {

            throw new ModelNotFoundException($e);
        }

    }
    public function handleAttributeRequest($request ){

        $is_filterable = $request->has('is_filterable')? 1:0;
        $is_required = $request->has('is_required')? 1:0;
        $arr= array([
            'is_filterable'=>$is_filterable,
            'is_required'=>$is_required
        ]);
        $request->merge($arr);
        return $request;

    }
    public function store( $request)
    {
        try {

            $request = handleAttributeRequest($request);

            return $this->create($request);

        } catch (QueryException $exception) {
            throw new InvalidArgumentException($exception->getMessage());
        }
    }

    public function update($request , $id)
    {
        $request = handleAttributeRequest($request);
        return this->edit($request , $id);
         
    }

}
