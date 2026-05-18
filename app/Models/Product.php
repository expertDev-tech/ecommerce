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
        'stock',
        'weight',
        'thumbnail',
        'description',
        'short_description',
        'view_count',
        'featured',
        'manage_stock',
        'in_stock',
        'status',
        'published_at',
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
}
