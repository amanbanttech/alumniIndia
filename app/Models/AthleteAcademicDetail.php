<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AthleteAcademicDetail extends Model
{
    use HasFactory;

    protected $table = 'athlete_academic_details';

    protected $fillable = [

        'athlete_id',

        // 10th
        'school_name',
        'tenth_board_id',
        'tenth_year',
        'tenth_result_type',
        'tenth_result',
        'tenth_marksheet',

        // 12th
        'twelfth_school_name',
        'twelfth_board_id',
        'twelfth_stream_id',
        'twelfth_year',
        'twelfth_result_type',
        'twelfth_result',
        'twelfth_marksheet',

                // 12th
        'diploma_college_name',
        'diploma_board_id',
        'diploma_stream_id',
        'diploma_year',
        'diploma_result_type',
        'diploma_result',
        'diploma_marksheet',

        // Graduation
        'graduation_university',
        'degree_id',
        'specialization',
        'graduation_year',
        'graduation_result_type',
        'graduation_result',
        'graduation_marksheet',
    ];


    /* 🔹 Relation: Academic → Athlete */
    public function athlete()
    {
        return $this->belongsTo(Athlete::class, 'athlete_id');
    }

    /* 10th Board Relation */
    public function tenthBoard()
    {
        return $this->belongsTo(Board::class, 'tenth_board_id');
    }

    /* 12th Board Relation */
    public function twelfthBoard()
    {
        return $this->belongsTo(Board::class, 'twelfth_board_id');
    }

    /* ===== 12th Stream ===== */
    public function twelfthStream()
    {
        return $this->belongsTo(TwelfthStream::class, 'twelfth_stream_id');
    }

    /* ===== Diploma Board ===== */
    public function diplomaBoard()
    {
        return $this->belongsTo(DiplomaBoard::class, 'diploma_board_id');
    }

    /* ===== Diploma Stream ===== */
    public function diplomaStream()
    {
        return $this->belongsTo(DiplomaStream::class, 'diploma_stream_id');
    }

    public function degree()
    {
        return $this->belongsTo(Degree::class, 'degree_id');
    }

        /* ===== Sport Relation (for mapping) ===== */
        // public function generalsport()
        // {
        //     return $this->belongsTo(Sport::class, 'sport_id');
        // }
}
