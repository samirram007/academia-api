<?php

namespace App\Http\Resources\FeeTemplate;

use App\Http\Resources\AcademicClass\AcademicClassResource;
use App\Http\Resources\AcademicYear\AcademicYearResource;
use App\Http\Resources\SuccessResource;
use Illuminate\Http\Request;


class FeeTemplateResource extends SuccessResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'is_active'=>$this->is_active,
            'academic_class_id'=>$this->academic_class_id,
            'academic_year_id'=>$this->academic_year_id,
            'academic_year'=> new AcademicYearResource($this->whenLoaded('academic_year')),
            'academic_class'=>new AcademicClassResource($this->whenLoaded('academic_class')),
            'fee_template_details'=>new FeeTemplateCollection($this->fee_template_details),


        ];
    }
}
