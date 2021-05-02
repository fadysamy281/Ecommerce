<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Repositories\BrandRepository;
use App\Repositories\Contracts\BrandInterface;
use App\Http\Requests\BrandRequest;

class BrandController extends Controller
{
    protected $brandRepository;

    public function __construct(BrandInterface $brandRepository)
    {
        $this->brandRepository = $brandRepository;
    }
    public function index()
    {
        $brands = $this->brandRepository->listBrands();

        $this->setPageTitle('Brands', 'List of all brands');
        return view('admin.brands.index', compact('brands'));
    }
    public function create()
    {
        $this->setPageTitle('Brands', 'Create Brand');
        return view('admin.brands.create');
    }
    public function store(BrandRequest $request)
    {

        $brand = $this->brandRepository->store($request);

        if (!$brand) 
        return $this->responseRedirectBack('Error occurred while creating brand.', 'error', true, true);
        
        return $this->responseRedirect('admin.brands.index', 'Brand added successfully' ,'success',false, false);
    }
    public function edit($id)
    {
        $brand = $this->brandRepository->findOneOrFail($id);

        $this->setPageTitle('Brands', 'Edit Brand : '.$brand->name);
        return view('admin.brands.edit', compact('brand'));
    }
    public function update(BrandRequest $request, $id)
    {


        $brand = $this->brandRepository->update($request,$id);

        if (!$brand) 
        return $this->responseRedirectBack('Error occurred while updating brand.', 'error', true, true);
        
        return $this->responseRedirectBack('Brand updated successfully' ,'success',false, false);
    }
    public function delete($id)
    {
        $brand = $this->brandRepository->delete($id);

        if (!$brand) {
            return $this->responseRedirectBack('Error occurred while deleting brand.', 'error', true, true);
        }
        return $this->responseRedirect('admin.brands.index', 'Brand deleted successfully' ,'success',false, false);
    }

}
