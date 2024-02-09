<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;
    protected $fillable=[
        'user_id',
        'total',
        'discount',
        'coupon_code',
        'first_name',
        'last_name',
        'address',
        'phone',
        'town',
        'state',
        'postal_code',
        'email',
        'notes',
        'status',
    ];
    public function product(){
        return $this->hasMany(OrderProduct::class);
    }
    public function user() {
        return $this->belongsTo(User::class);
    }
}
