<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class VideoLike extends Model
{
    protected $fillable = [
        'video_id',
        'user_id'
    ];

    public function video()
    {
        return $this->belongsTo(AthleteVideo::class,'video_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class,'user_id');
    }
}