<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Product;
use App\Models\AttributeValue;
use App\Models\Attribute;

class ProductAttribute extends Model
{
    use HasFactory;
    protected $table = 'product_attributes';
    protected $fillable = ['product_id', 'quantity', 'price'];

    public function product()
    {
        return $this->belongsTo(Product::class,'product_id','id');
    }
    public function attributesValues()
    {
        return $this->belongsToMany(AttributeValue::class,'attribute_value_product_attribute',
                'product_attribute_id','attribute_value_id','id','id');
    }
    public function attribute()
    {
        return $this->belongsTo(Attribute::class);
    }
}
