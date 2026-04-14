<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UniversityScholarship extends Model
{
    use HasFactory;

    protected $table = 'university_scholarships';

    protected $casts = [
    'open_from' => 'date',
    'end' => 'date',
];
    protected $fillable = [
        'university_id',
        'scholarship_id',
        'title',
        'description',
        'open_from',
        'end',
    ];


    public function university()
    {
        return $this->belongsTo(University::class, 'university_id');
    }

    public function seats()
    {
        return $this->hasMany(ScholarshipSeat::class, 'scholarship_id');
    }

    public function athleteScholarship()
    {
        return $this->hasMany(AthleteScholarship::class, 'university_scholarship_id');
    }
}
