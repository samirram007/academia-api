<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TransportExpense extends Model
{
    use HasFactory;
    protected $fillable = [
        'expense_no',
        'expense_date',
        'expense_template_id',
        'user_id',
        'academic_session_id',
        'campus_id',
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
    public function academic_session() {
        return $this->belongsTo(AcademicSession::class);
    }
    public function campus() {
        return $this->belongsTo(Campus::class);
    }
    public function transport_expense_items(){
        return $this->hasMany(TransportExpenseItem::class);
    }
}
