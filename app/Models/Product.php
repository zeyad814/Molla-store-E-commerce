<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Category;
use App\Models\Brand;

class Product extends Model
{
    use HasFactory;
    protected $fillable = [
            'category_id',
            'brand_id',
            'product_code',
            'product_name',
            'product_color',
            'product_price',
            'product_discount',
            'discount_type',
            'final_price',
            'product_video',
            'main_image',
            'image_1',
            'image_2',
            'image_3',
            'description',
            'is_bestseller',
            'stock',
            'sku',
            'meta_title',
            'meta_description',
            'meta_keywords',
            'is_featured',
            'status',
    ];
    public function category(){
        return $this->belongsTo(Category::class);
    }
    public function brand(){
        return $this->belongsTo(Brand::class);
    }
    public static function productStock($product_id){
        $productStock= Product::select('stock')->where(['product_id'=>$product_id])->first();
        return $productStock->stock;
    }
    public function order(){
        return $this->hasMany(OrderProduct::class);
    }
    public function rate(){
        return $this->hasMany(ProductRate::class);
    }

}
