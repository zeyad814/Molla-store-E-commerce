<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    use HasFactory;
    protected $fillable=[
        'price',
        'total',
        'product_qty',
        'product_id',
        'user_id',
    ];
    public function product(){
        return $this->belongsTo(Product::class);
    }
}
