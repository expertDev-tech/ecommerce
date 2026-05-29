<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ProductVideo extends Model
{
    use SoftDeletes;
    
    protected $fillable = [
        'product_id',
        'title',
        'video_type',
        'video_url',
        'thumbnail',
        'is_primary',
        'sort_order',
    ];

    protected $casts = [

        'is_primary' => 'boolean',

        'status' => 'boolean',
    ];

    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}
