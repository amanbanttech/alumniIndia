<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UniversityCourse extends Model
{
    protected $table = 'university_courses';

    protected $fillable = [
        'university_id',
        'university_course_id',
    ];

    public function university()
    {
        return $this->belongsTo(University::class, 'university_id');
    }

    public function course()
    {
        return $this->belongsTo(Course::class, 'university_course_id');
    }
}