<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Laravel\Passport\HasApiTokens;

class FeeItemMonth extends Model
{
    use HasApiTokens,HasFactory;
    protected $fillable = [
        'fee_item_id',
        'student_session_id',
        'month_id',
        'amount',
    ];
    public function fee_item()
    {
        return $this->belongsTo(FeeItem::class);
    }

    public function student_session()
    {
        return $this->belongsTo(StudentSession::class);
    }
    public function month()
    {
        return $this->belongsTo(Month::class,'month_id');
    }
}
