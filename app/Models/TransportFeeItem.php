<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TransportFeeItem extends Model
{
    use HasFactory;
    protected $fillable = [
        'transport_fee_id',
        'fee_head_id',
        'quantity',
        'months',
        'amount',
        'is_active',
        'keep_periodic_details',
        'is_customizable',
        'is_deleted',
        'total_amount',
    ];
    public function transport_fee()
    {
        return $this->belongsTo(TransportFee::class, 'transport_fee_id');
    }

    public function fee_head()
    {
        return $this->belongsTo(FeeHead::class, 'fee_head_id');
    }
    public function transport_fee_item_months(){
        return $this->hasMany(TransportFeeItemMonth::class);
    }
}
