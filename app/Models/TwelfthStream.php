<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TwelfthStream extends Model
{
    protected $table = 'twelfth_streams';

    protected $fillable = [
        'stream'
    ];

    /* Relation: Many athletes can have same stream */
    public function academicDetails()
    {
        return $this->hasMany(AthleteAcademicDetail::class, 'twelfth_stream_id');
    }
}
