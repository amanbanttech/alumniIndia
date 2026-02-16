<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UniversitySport extends Model
{
    protected $fillable = [
        'university_id',
        'name',
        'category'
    ];

    public function university()
    {
        return $this->belongsTo(University::class, 'university_id');
    }

    public function mentors()
    {
        return $this->hasMany(Mentor::class, 'sport_id');
    }


}

