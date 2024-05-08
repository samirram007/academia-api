<?php

namespace App\Http\Resources\FeeTemplate;

use Illuminate\Http\Request;
use App\Http\Resources\SuccessResource;
use App\Http\Resources\Campus\CampusResource;
use App\Http\Resources\AcademicSession\AcademicSessionResource;
use App\Http\Resources\AcademicClass\AcademicClassResource;
use App\Http\Resources\FeeTemplateItem\FeeTemplateItemCollection;

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
            'campus_id'=>$this->campus_id,
            'academic_class_id'=>$this->academic_class_id,
            'academic_session_id'=>$this->academic_session_id,
            'academic_session'=> new AcademicSessionResource($this->whenLoaded('academic_session')),
            'academic_class'=>new AcademicClassResource($this->whenLoaded('academic_class')),
            'campus'=>new CampusResource($this->whenLoaded('campus')),
            'fee_template_items'=>new FeeTemplateItemCollection($this->whenLoaded('fee_template_items')),



        ];
    }
}
