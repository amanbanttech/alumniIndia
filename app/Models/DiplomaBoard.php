<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DiplomaBoard extends Model
{
    protected $table = 'diploma_boards';

    protected $fillable = [
        'board'
    ];

    public function academicDetails()
    {
        return $this->hasMany(AthleteAcademicDetail::class, 'diploma_board_id');
    }
}
