<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductRate extends Model
{
    use HasFactory;
    protected $fillable =[
        'name',
        'comment',
        'rating',
        'description',
        'email',
        'product_id',
        'status',
    ];
    public function product(){
        return $this->belongsTo(Product::class);
    }
}
