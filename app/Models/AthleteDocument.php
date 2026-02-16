<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AthleteDocument extends Model
{
    protected $table = 'athlete_documents';

    protected $fillable = [

        'athlete_id',

        'profile_photo',
        'government_proof',
        'dob_proof',
        'address_proof',


        'sport_achievement',
        'coach_recommendation',
        'medical_fitness',
        'player_contract',

        'reference_name1',
        'reference_role1',
        'reference_academy1',
        'reference_relationship1',
        'reference_number1',
        'reference_email1',
        'reference_document1',


        'reference_name2',
        'reference_role2',
        'reference_academy2',
        'reference_relationship2',
        'reference_number2',
        'reference_email2',
        'reference_document2',



    ];

    /**
     * Relation: Document belongs to Athlete
     */
    public function athlete()
    {
        return $this->belongsTo(Athlete::class);
    }
}
