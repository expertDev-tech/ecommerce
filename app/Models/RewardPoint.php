<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RewardPoint extends Model
{
    protected $fillable = [
        'user_id',
        'points',
        'type',
        'remarks',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
