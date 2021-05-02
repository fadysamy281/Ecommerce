<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Attribute;
use App\Models\ProductAttribute;

class AttributeValue extends Model
{
    use HasFactory;
    protected $table = 'attribute_values';

    protected $fillable = [
        'attribute_id', 'value', 'price'
    ];

    public function attribute()
    {
        return $this->belongsTo(Attribute::class,'attribute_id','id');
    }
    public function productAttributes()
    {
        return $this->belongsToMany(ProductAttribute::class,'attribute_value_product_attribute',
        'attribute_value_id','product_attribute_id','id','id');
    }
}
