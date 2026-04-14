<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Nationality extends Model
{
    protected $fillable = [
        'country_name',
        'nationality'
    ];

    public function athletes()
    {
        return $this->hasMany(Athlete::class);
    }
}