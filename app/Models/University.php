<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class University extends Model
{
    use HasFactory;

    protected $table = 'universities';

    protected $fillable = [
        'user_id',
        'state',
        'city',
        'state_id',
        'about',
        'address',
        'emblem_logo',
        'sports_logo',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function state()
    {
        return $this->belongsTo(State::class);
    }

    public function sports()
    {
        return $this->hasMany(UniversitySport::class, 'university_id');
    }

    public function subUniversities()
    {
        return $this->hasMany(SubUniversity::class);
    }


    public function scholarships()
    {
        return $this->hasMany(UniversityScholarship::class, 'university_id');
    }

    public function scholarshipSeats()
    {
        return $this->hasMany(ScholarshipSeat::class, 'university_id');
    }

    public function courses()
    {
        return $this->belongsToMany(
            Course::class,
            'university_courses',       // pivot table
            'university_id',            // FK here
            'university_course_id'      // FK there
        )->withPivot('id');
    }
}
