<?php

namespace App\Models;

use Laravel\Sanctum\HasApiTokens;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Examination extends Model
{
    use HasApiTokens,HasFactory;
    protected $fillable = [
        'name',
        'examination_types_id',
        'examination_start_date',
        'examination_end_date',
        'academic_session_id',
        'campus_id',
    ];


    public function examination_types()
    {
        return $this->belongsTo(ExaminationType::class);
    }
    public function academic_session()
    {
        return $this->belongsTo(AcademicSession::class);
    }
    public function campus()
    {
        return $this->belongsTo(Campus::class);
    }

}
