<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PriceMarkup extends Model
{
    protected $fillable = [
        'name',
        'calculation_type',
        'amount',
        'priority',
        'stop_further_rules',
        'status',
        'start_date',
        'end_date',
    ];

    public function conditions()
    {
        return $this->hasMany(PriceMarkupCondition::class);
    }
}
