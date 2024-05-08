<?php

namespace App\Http\Resources\StudentSession;

use App\Http\Resources\AcademicClass\AcademicClassResource;
use App\Http\Resources\AcademicSession\AcademicSessionResource;
use App\Http\Resources\AcademicStandard\AcademicStandardResource;
use App\Http\Resources\SuccessResource;
use App\Http\Resources\User\UserResource;
use Illuminate\Http\Request;

class StudentSessionResource extends SuccessResource
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
            'student_id' => $this->student_id,
            'academic_session_id' => $this->academic_session_id,
            'academic_class_id' => $this->academic_class_id,
            'academic_standard_id' => $this->academic_standard_id,
            'roll_no' => $this->roll_no,
            'status' => $this->status,
            'student'=> $this->whenNotNull(new UserResource($this->whenLoaded('student'))),
            'academic_session'=> $this->whenNotNull(new AcademicSessionResource($this->whenLoaded('academic_session'))),
            'academic_class'=> $this->whenNotNull(new AcademicClassResource($this->whenLoaded('academic_class'))),
            'academic_standard'=> $this->whenNotNull(new AcademicStandardResource($this->whenLoaded('academic_standard'))),
        ];
    }
}
