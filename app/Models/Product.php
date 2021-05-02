<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Brand;
use App\Models\ProductImage;
use App\Models\ProductAttribute;
use App\Models\Category;

class Product extends Model
{
    use HasFactory;
    protected $table = 'products';
    protected $fillable = [
         'sku', 'name', 'slug', 'description', 'quantity','weight',
         'price', 'sale_price', 'status', 'featured','brand_id',
    ];
    protected $casts = [
        'quantity'  =>  'integer',
        'brand_id'  =>  'integer',
        'status'    =>  'boolean',
        'featured'  =>  'boolean'
    ];
    public function brand()
    {
        return $this->belongsTo(Brand::class,'brand_id','id');
    }
    public function images()
    {
        return $this->hasMany(ProductImage::class,'product_id','id');
    }
    public function attributes()
    {
        return $this->hasMany(ProductAttribute::class,'product_id','id');
    }
    public function categories()
    {
        return $this->belongsToMany(Category::class, 'product_categories',
         'product_id', 'category_id','id','id');
    }
}
