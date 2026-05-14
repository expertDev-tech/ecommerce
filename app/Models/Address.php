<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Address extends Model
{
    protected $fillable = [
        'user_id',
        'type',
        'full_name',
        'phone',
        'country',
        'state',
        'city',
        'postal_code',
        'address_line_1',
        'address_line_2',
        'is_default',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
