<?php

namespace App\Models;

use Laravel\Sanctum\HasApiTokens;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class SubjectGroup extends Model
{
    use HasApiTokens,HasFactory;
    protected $fillable = [
        'name',
        'code',
        'description',
        'logo_image_id'
    ];
    public function logo_image()
    {
        return $this->belongsTo(Document::class, 'logo_image_id');
    }
    public function subjects()
    {
        return $this->hasMany(Subject::class);
    }
}
