<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\Pivot;

class StudentSession extends Pivot
{
    protected $table = 'student_session';

    protected $fillable = [
        'student_id', 'academic_session_id', 'academic_class_id','academic_standard_id','roll_no','status'
        // Add any additional fillable columns here
    ];
    function student(){
        return $this->belongsTo(User::class,'student_id');
    }

    function academic_session(){
        return $this->belongsTo(AcademicSession::class);
    }

    function academic_class(){
        return $this->belongsTo(AcademicClass::class);
    }

    function academic_standard(){
        return $this->belongsTo(AcademicStandard::class);
    }

}
