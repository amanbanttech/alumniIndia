<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AthleteAssignMentor extends Model
{
    use HasFactory;

    protected $table = 'athlete_assign_mentors';

    protected $fillable = [
        'athlete_id',
        'mentor_id'
    ];

    public function athlete()
    {
        return $this->belongsTo(Athlete::class, 'athlete_id');
    }

    public function mentor()
    {
        return $this->belongsTo(Mentor::class, 'mentor_id');
    }
}