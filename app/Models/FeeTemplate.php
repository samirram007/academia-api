<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class FeeTemplate extends Model
{
    use  HasFactory;
    protected $fillable = [
        'name',
        'is_active',
        'campus_id',
        'academic_session_id',
        'academic_class_id'
    ];

    public function campus() {
        return $this->belongsTo(Campus::class);
        }
    public function academic_session() {
        return $this->belongsTo(AcademicSession::class);
        }
        public function academic_class() {
        return $this->belongsTo(AcademicClass::class);
        }
     public function fee_template_items() {
        return $this->hasMany(FeeTemplateItem::class);
        }

}
