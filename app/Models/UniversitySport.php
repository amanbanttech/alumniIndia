<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UniversitySport extends Model
{
    protected $fillable = [
        'university_id',
        'sport_id',
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


    public function sport()
    {
        return $this->belongsTo(Sport::class, 'sport_id');
    }

    public function scholarshipSeats()
    {
        return $this->hasMany(ScholarshipSeat::class, 'sport_id');
    }

}

