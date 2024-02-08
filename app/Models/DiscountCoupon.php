<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DiscountCoupon extends Model
{
    use HasFactory;
    protected $fillable=[
        'max_uses',
        'name',
        'description',
        'code',
        'discount_amount',
        'starts_at',
        'status',
        'expires_at',
        'type',
    ];
}
