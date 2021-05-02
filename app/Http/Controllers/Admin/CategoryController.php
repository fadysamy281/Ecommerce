<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Repositories\Contracts\CategoryInterface;
use App\Http\Requests\CategoryRequest;

class CategoryController extends Controller
{
    protected $categoryRepository;
    public function __construct(CategoryInterface $categoryRepository)
    {
        $this->categoryRepository = $categoryRepository;
    }
    public function index()
    {// very small records in categories table
        $categories = $this->categoryRepository->
        listCategories();

        $this->setPageTitle('Categories', 'List of all categories');
        return view('admin.categories.index', compact('categories'));
    }
    public function create()
    {
        $categories = $this->categoryRepository->treeList();
        // FOR CHOOSING PARENT_CATEGORY
        $this->setPageTitle('Categories', 'Create Category');
        return view('admin.categories.create', compact('categories'));
    }
    public function store(CategoryRequest $request)
    {
        $category = $this->categoryRepository->create($request);

        if (!$category) {
            return $this->responseRedirectBack('Error occurred while creating category.', 'error', true, true);
        }
        return $this->responseRedirect('admin.categories.index', 'Category added successfully' ,'success',false, false);
    }
    public function edit($id)
    {
        $targetCategory = $this->categoryRepository->findOneOrFail($id);
        $categories = $this->categoryRepository->treeList();

        $this->setPageTitle('Categories', 'Edit Category : '.$targetCategory->name);
        return view('admin.categories.edit', compact('categories', 'targetCategory'));
    }
    public function update(CategoryRequest $request,$id)
    {
        $category = $this->categoryRepository->update($request,$id);

        if (!$category) 
        return $this->responseRedirectBack('Error occurred while updating category.', 'error', true, true);
        
        return $this->responseRedirectBack('Category updated successfully' ,'success',false, false);
    }
    public function delete($id)
    {
        $category = $this->categoryRepository->delete($id);

        if (!$category) {
            return $this->responseRedirectBack('Error occurred while deleting category.', 'error', true, true);
        }
        return $this->responseRedirect('admin.categories.index', 'Category deleted successfully' ,'success',false, false);
    }

}
