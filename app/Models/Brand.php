<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Brand extends Model
{
    use HasFactory;


    protected $fillable =
    [
        'brand_name',
        'brand_image',
        'brand_logo' ,
        'brand_discount',
        'description' ,
        'meta_title' ,
        'meta_description',
        'meta_keywords',
    ];
}
