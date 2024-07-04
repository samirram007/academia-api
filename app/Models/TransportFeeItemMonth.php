<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Laravel\Passport\HasApiTokens;

class TransportFeeItemMonth extends Model
{
    use HasApiTokens,HasFactory;
    protected $fillable = [
        'transport_fee_item_id',
        'academic_session_id',
        'user_id',
        'month_id',
        'amount',
    ];
    public function transport_fee_item()
    {
        return $this->belongsTo(TransportFeeItem::class);
    }

    public function academic_session()
    {
        return $this->belongsTo(AcademicSession::class);
    }
    public function month()
    {
        return $this->belongsTo(Month::class,'month_id');
    }
}
