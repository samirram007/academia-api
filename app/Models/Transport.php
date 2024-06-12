<?php

namespace App\Models;

use Laravel\Sanctum\HasApiTokens;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Transport extends Model
{
    use HasApiTokens,HasFactory;
    protected $fillable = [
        'name',
        'registration_no',
        'registration_date',
        'registration_valid_date',
        'chasis_no',
        'engine_no',
        'color',
        'capacity',
        'transport_type_id',
    ];
    public function transport_type(){
        return $this->belongsTo(TransportType::class);
    }
}
