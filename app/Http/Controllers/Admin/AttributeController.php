<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Repositories\Contracts\AttributeInterface;
use App\Http\Requests\AttributeRequest;

class AttributeController extends Controller
{
    protected $attributeRepository;

    public function __construct(AttributeInterface $attributeRepository)
    {
        $this->attributeRepository = $attributeRepository;
    }
    public function index()
    {
        $attributes = $this->attributeRepository->listAttributes();

        $this->setPageTitle('Attributes', 'List of all attributes');
        return view('admin.attributes.index', compact('attributes'));
    }
    public function create()
    {
        $this->setPageTitle('Attributes', 'Create Attribute');
        return view('admin.attributes.create');
    }
    public function store(AttributeRequest $request)
    {

        $attribute = $this->attributeRepository->store($request);

        if (!$attribute) {
            return $this->responseRedirectBack('Error occurred while creating attribute.', 'error', true, true);
        }
        return $this->responseRedirect('admin.attributes.index', 'Attribute added successfully' ,'success',false, false);
    }
    public function edit($id)
    {
        $attribute = $this->attributeRepository->findOneOrFail($id);

        $this->setPageTitle('Attributes', 'Edit Attribute : '.$attribute->name);
        return view('admin.attributes.edit', compact('attribute'));
    }
    public function update(AttributeRequest $request,$id)
    {
        /*$this->validate($request, [
            'code'          =>  'required',
            'name'          =>  'required',
            'frontend_type' =>  'required'
        ]);*/


        $attribute = $this->attributeRepository->update($request,$id);

        if (!$attribute) {
            return $this->responseRedirectBack('Error occurred while updating attribute.', 'error', true, true);
        }
        return $this->responseRedirectBack('Attribute updated successfully' ,'success',false, false);
    }
    public function delete($id)
    {
        $attribute = $this->attributeRepository->delete($id);

        if (!$attribute) {
            return $this->responseRedirectBack('Error occurred while deleting attribute.', 'error', true, true);
        }
        return $this->responseRedirect('admin.attributes.index', 'Attribute deleted successfully' ,'success',false, false);
    }
}
