<?php

namespace App\Models;

use App\Models\User;
use App\Models\State;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class AcademicSession extends Model
{
    use HasApiTokens,HasFactory;

    protected $fillable = [
        'session',
        'start_date',
        'end_date',
        'is_current',
        'previous_academic_session_id',
        'next_academic_session_id',
     ];
     public function previous_academic_session() {
        return $this->belongsTo(AcademicSession::class, 'previous_academic_session_id');
     }
     public function next_academic_session() {
        return $this->belongsTo(AcademicSession::class, 'next_academic_session_id');
     }


}
