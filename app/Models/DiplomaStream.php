<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DiplomaStream extends Model
{
    protected $table = 'diploma_streams';

    protected $fillable = [
        'stream'
    ];

    public function academicDetails()
    {
        return $this->hasMany(AthleteAcademicDetail::class, 'diploma_stream_id');
    }
}
