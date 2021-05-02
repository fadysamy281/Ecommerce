<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
//Str::slug($value)
use App\Models\Product;

class Brand extends Model
{
    use HasFactory;
    protected $table = 'brands';
    protected $fillable = ['name', 'slug', 'logo'];

    public function products()
    {
        return $this->hasMany(Product::class,'brand_id','id');
    }
}
