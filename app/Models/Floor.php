<?php

namespace App\Models;

use Laravel\Sanctum\HasApiTokens;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Floor extends Model
{
    use HasApiTokens,HasFactory;
    protected $fillable = [
        'name',
        'code',
        'building_id',
        'capacity'
    ];
    public function building() {
        return $this->belongsTo(Building::class);
     }

}
