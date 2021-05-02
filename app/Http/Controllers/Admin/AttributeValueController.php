<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Repositories\Contracts\AttributeInterface;
use App\Models\AttributeValue;

class AttributeValueController extends Controller
{
    protected $attributeRepository;

    public function __construct(AttributeInterface $attributeRepository)
    {
        $this->attributeRepository = $attributeRepository;
    }
    public function getValues( $id)
    {
        $attribute = $this->attributeRepository->findAttributeById($id);

        $values = $attribute->values();

        return response()->json($values);
    }
    public function addValues(Request $request)
    {
        $value = AttributeValue::create([
            'attribute_id' => $request->id,
            'value' => $request->value,
            'price' => $request->price,
        ]);

        return response()->json($value);
    }
    public function updateValues(Request $request)
    {
        $attributeValue = AttributeValue::findOrFail($request->valueId);
        $attributeValue->update([
            'attribute_id' => $request->id,
            'value' => $request->value,
            'price' => $request->price,
        ]);

        return response()->json($attributeValue);
    }
    public function deleteValues(Request $request)
    {
        $attributeValue = AttributeValue::findOrFail($request->id);
        $attributeValue->delete();

        return response()->json(['status' => 'success',
            'message' => 'Attribute value deleted successfully.']);
    }
}
