<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PriceMarkupCondition extends Model
{
    protected $fillable = [
        'price_markup_id',
        'condition_type',
        'reference_id',
    ];

    public function priceMarkup()
    {
        return $this->belongsTo(PriceMarkup::class);
    }
}
