<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserInformation extends Model
{
    use HasFactory;
    protected $fillable=[
        'first_name',
        'user_id',
        'last_name',
        'email',
        'address',
        'postal_code',
        'state',
        'town',
        'phone',
    ];
}
