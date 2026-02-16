<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SubUniversity extends Model
{
    protected $fillable = [
        'university_id',
        'user_id',
        'name',
    ];

    public function university()
    {
        return $this->belongsTo(University::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
