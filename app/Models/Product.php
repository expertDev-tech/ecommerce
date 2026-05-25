<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
    use SoftDeletes;
    
    protected $fillable = [
        'brand_id',
        'category_id',
        'name',
        'slug',
        'sku',
        'barcode',
        'price',
        'sale_price',
        'cost_price',
        'stock',
        'weight',
        'description',
        'short_description',
        'meta_title',
        'meta_description',
        'view_count',
        'is_featured',
        'manage_stock',
        'in_stock',
        'status',
        'published_at',
    ];

    protected $casts = [

        'manage_stock' => 'boolean',

        'is_featured' => 'boolean',

        'in_stock' => 'boolean',

    ];

    public function brand()
    {
        return $this->belongsTo(Brand::class);
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function images()
    {
        return $this->hasMany(ProductImage::class);
    }

    public function videos()
    {
        return $this->hasMany(ProductVideo::class);
    }

    public function attributeValues()
    {
        return $this->hasMany(AttributeValue::class);
    }

    public function variants()
    {
        return $this->hasMany(ProductVariant::class);
    }

    public function collections()
    {
        return $this->belongsToMany(ProductCollection::class);
    }

    public function primaryImage()
    {
        return $this->hasOne(
            ProductImage::class
        )->where(
            'is_primary',
            true
        );
    }
}
