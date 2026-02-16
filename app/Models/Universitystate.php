<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UniversityState extends Model
{
    protected $table = 'university_states';

    protected $fillable = [
        'university_id',
        'state_id',
    ];

    public $timestamps = true;
}
