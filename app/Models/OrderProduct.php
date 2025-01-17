<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderProduct extends Model
{
    use HasFactory;
    protected $fillable=[
        'user_id',
        'product_id',
        'order_id',
        'product_qty',
        'price',
        'total',
        'name',
    ];
    public function product(){
        return $this->belongsTo(Product::class);
    }
}
