<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Attribute extends Model
{
    use SoftDeletes;
    
    protected $fillable = [
        'category_id',
        'name',
        'slug',
        'type',
        'is_filterable',
        'is_required',
        'status',
    ];

    protected $casts = [
        'is_filterable' => 'boolean',
        'is_required' => 'boolean',
        'status' => 'boolean',
    ];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function attributeValues()
    {
        return $this->hasMany(AttributeValue::class);
    }

    public function variantAttributeValues()
    {
        return $this->hasMany(VariantAttributeValue::class);
    }
}
