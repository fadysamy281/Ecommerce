<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;
use App\Models\Product;
use TypiCMS\NestableTrait;

class Category extends Model
{
    use HasFactory,Sluggable,NestableTrait;
    protected $table = 'categories';

    protected $fillable = [
        'name', 'slug', 'description', 'parent_id', 'featured', 'menu', 'image'
    ];

    protected $casts = [
        'parent_id' =>  'integer',
        'featured'  =>  'boolean',
        'menu'      =>  'boolean'
    ];

    public function sluggable(){
        return [
            'slug'=>['source'=>'title']
        ];
    }
####   Relationships        ##########
    public function parent()
    {
        return $this->belongsTo(Category::class, 'parent_id','id');
    }
    public function children()
    {
        return $this->hasMany(Category::class, 'parent_id','id');
    }
    public function products()
    {
        return $this->belongsToMany(Product::class, 'product_categories', 'category_id', 'product_id','id','id');
    }
}
