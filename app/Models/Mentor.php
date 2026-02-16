<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Mentor extends Model
{
    use HasFactory;

    // 🔹 Mass assignable fields
    protected $fillable = [
        'user_id',
        'sport_id',
    ];

    /**
     * Mentor belongs to a User
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Mentor belongs to a University Sport
     */
    public function sport()
    {
        return $this->belongsTo(UniversitySport::class);
    }
}
