<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AthleteUniversityPreference extends Model
{
    use HasFactory;

    protected $table = 'athlete_university_preferences';

    protected $fillable = [
        'athlete_id',
        'firstPreference',
        'secondPreference',
        'thirdPreference',
    ];

    // Relation: Preference -> Athlete
    public function athlete()
    {
        return $this->belongsTo(
            Athlete::class,
            'athlete_id',
            'id'
        );
    }
}