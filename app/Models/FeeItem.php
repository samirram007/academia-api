<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FeeItem extends Model
{
    use HasFactory;
    protected $fillable = [
        'fee_id',
        'fee_head_id',
        'no_of_months',
        'monthly_fee_amount',
        'months',
        'amount',
    ];
    public function fee()
    {
        return $this->belongsTo(Fee::class, 'fee_id');
    }

    public function fee_head()
    {
        return $this->belongsTo(FeeHead::class, 'fee_head_id');
    }
}
