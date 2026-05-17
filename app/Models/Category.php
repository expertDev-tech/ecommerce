<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $fillable = [
        'parent_id',
        'name',
        'slug',
        'image',
        'description',
        'sort_order',
        'show_in_menu',
        'status',
    ];

    protected $casts = [
        'show_in_menu' => 'boolean',
        'status' => 'boolean',
    ];

    public function parent()
    {
        return $this->belongsTo(Category::class, 'parent_id');
    }

    public function children()
    {
        return $this->hasMany(Category::class, 'parent_id');
    }

    public function products()
    {
        return $this->hasMany(Product::class);
    }

    public function attributeValues()
    {
        return $this->hasMany(AttributeValue::class);
    }

    public static function getNestedCategories($categories,$parentId = null,$prefix = '') {

        $nested = [];

        foreach ($categories->where('parent_id', $parentId) as $category) {

            $category->label = $prefix . $category->name;

            $nested[] = $category;

            $children = self::getNestedCategories(
                $categories,
                $category->id,
                $prefix . '— '
            );

            $nested = array_merge(
                $nested,
                $children
            );
        }

        return $nested;
    }
}
