<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AthleteScholarship extends Model
{
    protected $table = 'athlete_scholarships';

    protected $fillable = [
        'athlete_id',
        'scholarship_seat_id',
        'university_scholarship_id'
    ];

    public function athlete()
    {
        return $this->belongsTo(Athlete::class,'athlete_id');
    }

    public function seat()
    {
        return $this->belongsTo(ScholarshipSeat::class,'scholarship_seat_id');
    }

    public function scholarship()
    {
        return $this->belongsTo(UniversityScholarship::class,'university_scholarship_id');
    }
}