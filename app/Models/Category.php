<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    public function parentCategory(){
        return $this->hasOne('App\Models\Category','id','parent_id')->select('id','category_name','url')
        ->where('status',1);
    }
    public function subCategories(){
        return $this->hasMany('App\Models\Category', 'parent_id')->where('status',1);
    }



        protected $fillable = [
        'parent_id',
        'category_name',
        'category_image',
        'category_discount',
        'description',
        'url',
        'meta_title',
        'meta_description',
        'meta_keywords',
        'status',
    ];
    public function products(){
        return $this->hasMany(Product::class);
    }



}
