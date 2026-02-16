<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class State extends Model
{
    protected $table = 'states';

    protected $fillable = [
        'name',
    ];

    public function universitys()
    {
        return $this->belongsToMany(
            University::class,
            'university_states',
            'state_id',
            'university_id'
        );
    }

    public function athletes()
    {
        return $this->hasMany(Athlete::class);
    }

}
