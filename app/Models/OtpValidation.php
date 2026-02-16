<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OtpValidation extends Model
{
    protected $fillable = [
        'phone',
        'otp',
        'type',
        'is_used',
        'expires_at',
    ];

    protected $casts = [
        'expires_at' => 'datetime',
        'is_used' => 'boolean',
    ];
}
