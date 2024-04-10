<?php

namespace App\Models;

use Laravel\Sanctum\HasApiTokens;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Building extends Model
{
    use HasApiTokens,HasFactory;
    protected $fillable = [
        'name',
        'code',
        'campus_id',
        'capacity'
    ];
    public function campus() {
        return $this->belongsTo(Campus::class);
     }
}
