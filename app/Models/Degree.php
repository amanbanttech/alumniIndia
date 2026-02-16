<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Degree extends Model
{
    use HasFactory;

    protected $table = 'degrees';

    protected $fillable = [
        'name',
    ];

    // Relation: One Degree → Many Academic Details
    public function academicDetails()
    {
        return $this->hasMany(AthleteAcademicDetail::class, 'degree_id');
    }
}
