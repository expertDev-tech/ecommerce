<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ShipmentTracking extends Model
{
    protected $fillable = [
        'order_id',
        'tracking_number',
        'carrier',
        'tracking_url',
        'status',
    ];

    public function order()
    {
        return $this->belongsTo(Order::class);
    }
}
