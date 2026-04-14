<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    protected $table = 'courses';

    protected $fillable = ['name'];

    public function universities()
    {
        return $this->belongsToMany(
            University::class,
            'university_courses',       // pivot table
            'university_course_id',     // FK in pivot (course side)
            'university_id'             // FK in pivot (university side)
        );
    }

    public function scholarshipSeats()
    {
        return $this->hasMany(ScholarshipSeat::class, 'course_id');
    }
}