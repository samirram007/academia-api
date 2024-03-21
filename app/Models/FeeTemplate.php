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
        'academic_year_id',
        'academic_class_id'
    ];
    public function academic_year() {
        return $this->belongsTo(AcademicYear::class);
        }
        public function academic_class() {
        return $this->belongsTo(AcademicClass::class);
        }
     public function fee_template_details() {
        return $this->hasMany(FeeTemplateDetails::class);
        }

}
