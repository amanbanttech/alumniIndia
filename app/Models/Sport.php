<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\AthleteSportDetail;


class Sport extends Model
{
    use HasFactory;

    // Table name (optional, Laravel default bhi yahi lega)
    protected $table = 'sports';

    // Mass assignable fields
    protected $fillable = [
        'name',
    ];

    // Disable timestamps (kyunki table me created_at / updated_at nahi hai)
    public $timestamps = false;

    /**
     * One Sport → Many UniversitySports (agar mapping use karoge)
     */

    // public function academicDetails()
    // {
    //     return $this->hasMany(AthleteAcademicDetail::class, 'sport_id');
    // }

    // Sport → Many Athletes
    public function athleteSportDetails()
    {
        return $this->hasMany(AthleteSportDetail::class, 'primary_sport_id');
    }

    public function sports()
    {
        return $this->hasMany(UniversitySport::class);
    }


}
