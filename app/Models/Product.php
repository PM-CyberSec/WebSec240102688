<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    
    protected $fillable = [
        'code',
        'name',
        'model',
        'photo',
        'price',
        'stock',
        'description'
    ];
}
