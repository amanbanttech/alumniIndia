<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ScholarshipSeat extends Model
{
    protected $table = 'scholarship_seats';

    protected $fillable = [
        'university_id',
        'scholarship_id',
        'university_sport_id',
        'course_id',
        'seat_alloted',
        'scholarship_amount',
    ];

    // Seat → University
    public function university()
    {
        return $this->belongsTo(University::class);
    }

    // Seat → Scholarship
    public function scholarship()
    {
        return $this->belongsTo(UniversityScholarship::class);
    }

    // Seat → Sport
    public function sport()
    {
        return $this->belongsTo(UniversitySport::class, 'university_sport_id');
    }

    // Seat → Course
    public function course()
    {
        return $this->belongsTo(Course::class, 'course_id');
    }

    public function athleteScholarship()
    {
        return $this->hasMany(AthleteScholarship::class, 'scholarship_seat_id');
    }


}