<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AthleteVideo extends Model
{
    use HasFactory;

    protected $table = 'athlete_videos';

    protected $fillable = [
        'athlete_id',
        'title',
        'visibility',
        'progress',
        'like_count',
        'about',
        'status',
        'video',
    ];

    public function athlete()
    {
        return $this->belongsTo(Athlete::class, 'athlete_id', 'id');
    }

    public function likes()
    {
        return $this->hasMany(VideoLike::class, 'video_id');
    }
}