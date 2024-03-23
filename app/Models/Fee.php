<?php

namespace App\Models;

use Laravel\Sanctum\HasApiTokens;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Fee extends Model
{
    use HasApiTokens,HasFactory;
    protected $fillable = [
        'fee_no',
        'fee_date',
        'fee_template_id',
        'student_id',
        'academic_session_id',
        'academic_class_id',
        'total_amount',
        'paid_amount',
        'balance_amount',
        'payment_mode',

    ];
    protected $hidden = [
        'created_at',
        'updated_at',
    ];
    public function fee_template() {
        return $this->belongsTo(FeeTemplate::class);
    }
    public function student() {
        return $this->belongsTo(User::class,'student_id');
    }
    public function academic_session() {
        return $this->belongsTo(Academicsession::class);
    }
    public function academic_class() {
        return $this->belongsTo(AcademicClass::class);
    }


}
