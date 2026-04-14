<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MentorFeedback extends Model
{
    protected $table = 'mentor_feedbacks';

    protected $fillable = [
        'athlete_id',
        'mentor_id',
        'feedback'
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