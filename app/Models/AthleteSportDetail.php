<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class AthleteSportDetail extends Model
{
    use HasFactory;

    protected $table = 'athlete_sport_details';

    protected $fillable = [

        'athlete_id',
        'primary_sport_id',
        'academy',
        'coach_name',
        'coach_contact',
        'training_experience',

        'height',
        'weight',
        'wingspan',
        'chest',
        'waist',
        'body_fat',
        'fitness_level',

        'state_ranking',
        'state_age_category',
        'district_ranking',
        'district_age_category',
        'national_ranking',
        'national_age_category',
        'best_performance',
        'medal_type',
        'international_participation',
        'gold_medal',
        'silver_medal',
        'bronze_medal',

        'previous_injury',
        'injury_details',
        'recovery_status',
        'medical_certificate',

        'sport_card',
        'coach_certificate',
    ];

    /* ================= Relations ================= */

    // Sport Detail → Athlete
    public function athlete()
    {
        return $this->belongsTo(Athlete::class);
    }

    // Sport Detail → Sport
    public function sport()
    {
        return $this->belongsTo(Sport::class, 'primary_sport_id');
    }
}
