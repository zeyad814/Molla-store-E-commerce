<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CmsPage extends Model
{
    use HasFactory;
    protected $fillable = [
        'url',
        'meta_description',
        'title',
        'description',
        'meta_keywords',
        'meta_title',
        'status',
    ];
}
