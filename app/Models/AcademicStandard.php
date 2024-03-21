<?php

namespace App\Models;

use Laravel\Sanctum\HasApiTokens;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class AcademicStandard extends Model
{
    use HasApiTokens,HasFactory;
    protected $fillable = [
        'name',
    ];
}
