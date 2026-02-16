<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Board extends Model
{
    use HasFactory;

    protected $fillable = ['name'];

    // One Board has Many Academic Records
    public function academicDetails()
    {
        return $this->hasMany(AthleteAcademicDetail::class, 'board_id');
    }
}
