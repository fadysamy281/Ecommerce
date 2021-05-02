<?php

namespace App\Repositories;

use App\Models\Category;
use App\Traits\FilesTrait;
use App\Repositories\Contracts\CategoryInterface;
use App\Repositories\BaseRepository;
use Illuminate\Http\UploadedFile;
use Illuminate\Database\QueryException;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Doctrine\Instantiator\Exception\InvalidArgumentException;

class CategoryRepository extends BaseRepository implements CategoryInterface
{
    use FilesTrait;

    protected $model;
    public function __construct(Category $model)
    {
        $this->model = $model;
    }

   /* public function createCategory($attributes)
    {
        return $this->model->create($attributes);
    }*/

   /* public function updateCategory($attributes,$id)
    {
        return $this->model->find($id)->update($attributes);
    }*/

    public function listCategories($order = 'id', $sort = 'desc', $columns = ['*'])
    {
        return $this->all($columns, $order, $sort);
    }



    public function handleCategoryRequest($request , $oldPhoto = null){
        //$oldPhoto = null ==>>create
        //$oldPhoto = null ==>>update_category_Image

        
            if(! is_null($oldPhoto)){
                $request->image = $this->updateFile($request->image ,
                CATEGORIES_PATH , $oldPhoto);
            }else{
                $request->image = $this->uploadFile($request->image ,
                CATEGORIES_PATH );
            }
        
        $featured = $request->has('featured')? 1:0;
        $menu = $request->has('menu')? 1:0;
        $arr= array([
            'featured'=>$featured,
            'menu'=>$menu
        ]);
        $request->merge($arr);
        return $request;
        /* $category = $category? $category->update($request->validated()):
                    Category::create($request->validated());*/

    }
    public function store($request){
        $request=handleCategoryRequest($request);
        return $this->create($request->validated());
    }
    public function update($request , $id){
        $category=$this->findOneOrFail($id);

        $request=handleCategoryRequest($request,$category->image);
        $category->update($request->validated());
    }
    public function delete($id)
    {
        $category=$this->findOneOrFail($id);

        if (! is_null($category->image) ) {
            $this->deleteFile(CATEGORIES_PATH , $category->image);
        }
      return $category->delete();
    }
    
    public function treeList()
    {
        return Category::orderByRaw('-name ASC')
            ->get()
            ->nest()
            ->listsFlattened('name');
    }
    public function findBySlug($slug)
    {
        return Category::with('products')
            ->where('slug', $slug)
            ->where('menu', 1)
            ->first();
    }
}
