<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class University extends Model
{
    use HasFactory;

    protected $table = 'universitys';

    protected $fillable = [
        'user_id',
        'state',
        'city',
        'about',
        'address',
        'emblem_logo',
        'sports_logo',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function states()
    {
        return $this->belongsToMany(
            State::class,
            'university_states',
            'university_id',
            'state_id'
        );
    }

    public function sports()
    {
        return $this->hasMany(UniversitySport::class, 'university_id');
    }

    public function subUniversities()
    {
        return $this->hasMany(SubUniversity::class);
    }



}
