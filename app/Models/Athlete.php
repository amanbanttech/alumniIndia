<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\AthleteSportDetail;
use App\Models\AthleteUniversityPreference;
use App\Models\AthleteVideo;


class Athlete extends Model
{
    use HasFactory;

    protected $fillable = [
        'athlete_id',
        'user_id',
        'name',
        'gender',
        'date_of_birth',
        'nationality_id',
        'address',
        'city',
        'zip_code',
        'state_id',
    ];

    // Athlete belongs to a User
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function state()
    {
        return $this->belongsTo(State::class);
    }

    public function academicDetail()
    {
        return $this->hasOne(
            AthleteAcademicDetail::class,
            'athlete_id'
        )->withDefault();
    }

    // Athlete → Sport Detail (One to One)
    public function sportDetail()
    {
        return $this->hasOne(AthleteSportDetail::class);
    }


    /**
     * Relation: Athlete has one document
     */
    public function document()
    {
        return $this->hasOne(AthleteDocument::class);
    }

    public function universityPreference()
    {
        return $this->hasOne(
            AthleteUniversityPreference::class,
            'athlete_id',
            'id'
        );
    }

    public function athleteScholarship()
    {
        return $this->hasMany(AthleteScholarship::class, 'athlete_id');
    }

    public function videos()
    {
        return $this->hasMany(AthleteVideo::class, 'athlete_id', 'id');
    }

    public function nationality()
    {
        return $this->belongsTo(Nationality::class);
    }

    public function mentorAssign()
    {
        return $this->hasOne(AthleteAssignMentor::class, 'athlete_id');
    }


    public function mentorFeedbacks()
    {
        return $this->hasMany(MentorFeedback::class, 'athlete_id');
    }
}
