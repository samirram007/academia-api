<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TransportUser extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id',
        'student_session_id',
        'transport_id',
        'pickup_slot_id',
        'drop_slot_id',
        'pickup_point_id',
        'drop_point_id',
        'pickup_time',
        'drop_time',
        'join_date',
        'dissociate_date',
        'is_active',
        'journey_type_id',
        'is_free',
        'monthly_charge',
        'idcard_print_count',
        'is_release_idcard_printable',
        'release_idcard_print_count',

    ];
    public function user(){
        return $this->belongsTo(User::class);
    }
    public function student_session(){
        return $this->belongsTo(StudentSession::class);
    }
    public function transport(){
        return $this->belongsTo(Transport::class);
    }
    public function pickup_slot(){
        return $this->belongsTo(TransportSlot::class,'pickup_slot_id');
    }
    public function drop_slot(){
        return $this->belongsTo(TransportSlot::class,'drop_slot_id');
    }
    public function pickup_point(){
        return $this->belongsTo(TransportPickupDrop::class,'pickup_point_id');
    }
    public function drop_point(){
        return $this->belongsTo(TransportPickupDrop::class,'drop_point_id');
    }
    public function journey_type(){
        return $this->belongsTo(JourneyType::class);
    }

}
