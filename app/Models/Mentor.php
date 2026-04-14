<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Mentor extends Model
{
    use HasFactory;

    // 🔹 Mass assignable fields
    protected $fillable = [
        'user_id',
        'sport_id',
        'university_id',
    ];

    /**
     * Mentor belongs to a User
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Mentor belongs to a University Sport
     */
    public function sport()
    {
        return $this->belongsTo(UniversitySport::class);
    }

    public function assignedAthletes()
    {
        return $this->hasMany(AthleteAssignMentor::class, 'mentor_id');
    }

    public function university()
    {
        return $this->belongsTo(University::class);
    }

 

    public function feedbacks()
    {
        return $this->hasMany(MentorFeedback::class, 'mentor_id');
    }
}
