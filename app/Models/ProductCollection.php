<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ProductCollection extends Model
{
    use SoftDeletes;
    
    protected $fillable = [
        'name',

        'slug',

        'description',

        'image',

        'is_featured',

        'meta_title',

        'meta_description',

        'status'
    ];

    protected $casts = [

        'is_featured' => 'boolean',

        'status' => 'boolean',
    ];

    public function products()
    {
        return $this->belongsToMany(
            Product::class,
            'collection_product'
        );
    }
}
