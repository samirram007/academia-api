<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TransportExpenseItem extends Model
{
    use HasFactory;
    protected $fillable = [
        'transport_expense_id',
        'expense_head_id',
        'quantity',
        'months',
        'amount',
        'total_amount',
    ];
    public function transport_expense()
    {
        return $this->belongsTo(TransportExpense::class, 'transport_expense_id');
    }

    public function expense_head()
    {
        return $this->belongsTo(ExpenseHead::class, 'expense_head_id');
    }
}
