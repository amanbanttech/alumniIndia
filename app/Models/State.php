<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class State extends Model
{
    protected $table = 'states';

    protected $fillable = [
        'name',
    ];

    public function university()
{
    return $this->hasMany(University::class);
}

    public function athletes()
    {
        return $this->hasMany(Athlete::class);
    }

}
