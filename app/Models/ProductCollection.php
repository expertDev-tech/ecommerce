<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProductCollection extends Model
{
    protected $fillable = [
        'name',
        'slug',
        'description',
        'featured',
        'status',
    ];

    public function products()
    {
        return $this->belongsToMany(Product::class);
    }
}
