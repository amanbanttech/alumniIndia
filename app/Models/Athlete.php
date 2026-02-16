<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\AthleteSportDetail;


class Athlete extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'name',
        'gender',
        'date_of_birth',
        'nationality',
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

}
