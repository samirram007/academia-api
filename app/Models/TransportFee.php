<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TransportFee extends Model
{
    use HasFactory;
    protected $fillable = [
        'fee_no',
        'fee_date',
        'user_id',
        'transport_user_id',
        'transport_id',
        'student_session_id',
        'campus_id',
        'academic_session_id',
        'total_amount',
        'paid_amount',
        'balance_amount',
        'payment_mode',

    ];
    protected $hidden = [
        'created_at',
        'updated_at',
    ];

    public function user() {
        return $this->belongsTo(User::class);
    }
    public function transport_user() {
        return $this->belongsTo(TransportUser::class);
    }
    public function transport() {
        return $this->belongsTo(Transport::class);
    }
    public function academic_session() {
        return $this->belongsTo(AcademicSession::class);
    }
    public function campus() {
        return $this->belongsTo(Campus::class);
    }

    public function student_session() {
        return $this->belongsTo(StudentSession::class) ;
    }
    public function transport_fee_items(){
        return $this->hasMany(TransportFeeItem::class);
    }
}
