<?php

namespace App\Http\Resources\Student;

use App\Http\Resources\AcademicClass\AcademicClassResource;
use App\Http\Resources\AcademicSession\AcademicSessionResource;
use App\Http\Resources\Address\AddressCollection;

use App\Http\Resources\Address\AddressResource;
use App\Http\Resources\Campus\CampusResource;
use App\Http\Resources\Document\DocumentResource;
use App\Http\Resources\StudentSession\StudentSessionCollection;
use App\Http\Resources\SuccessResource;
use App\Http\Resources\User\UserCollection;
use App\Models\Campus;
use Illuminate\Http\Request;

class StudentResource extends SuccessResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */


    public function toArray(Request $request): array
    {

        $data=[
            'id' => $this->id,
            'username' => $this->username,
            'user_type' => $this->user_type,
            'addresses'=>  new AddressCollection($this->whenLoaded('addresses')),
            // 'address'=>  new AddressResource($this->whenLoaded('address')),
            'code'=>$this->whenNotNull($this->code),
            'name'=>$this->name,
            'email'=>$this->whenNotNull($this->email),
            'contact_no'=>$this->whenNotNull($this->contact_no),
            'gender'=>$this->whenNotNull($this->gender),
            'status'=>$this->whenNotNull($this->status),
            'emergency_contact_name'=>$this->whenNotNull($this->emergency_contact_name),
            'emergency_contact_no'=>$this->whenNotNull($this->emergency_contact_no),
            'birth_mark'=>$this->whenNotNull($this->birth_mark),
            'medical_conditions'=>$this->whenNotNull($this->medical_conditions),
            'allergies'=>$this->whenNotNull($this->allergies),
            'nationality'=>$this->whenNotNull($this->nationality),
            'religion'=>$this->whenNotNull($this->religion),
            'caste'=>$this->whenNotNull($this->caste),
            'language'=>$this->whenNotNull($this->language),
            'guardian_type'=>$this->whenNotNull($this->guardian_type),
            'address_id'=>$this->whenNotNull($this->address_id),
            'designation_id'=>$this->whenNotNull($this->designation_id),
            'department_id'=>$this->whenNotNull($this->department_id),

            'doj'=>$this->whenNotNull($this->doj),
            'dob'=>$this->whenNotNull($this->dob),
            'aadhaar_no'=>$this->whenNotNull($this->aadhaar_no),
            'pan_no'=>$this->whenNotNull($this->pan_no),
            'passport_no'=>$this->whenNotNull($this->passport_no),
            'profile_document_id'=>$this->whenNotNull($this->profile_document_id),
            'profile_document'=>  new DocumentResource($this->whenLoaded('profile_document')),
            'bank_name'=>$this->whenNotNull($this->bank_name),
            'account_holder_name'=>$this->whenNotNull($this->account_holder_name),
            'bank_ifsc'=>$this->whenNotNull($this->bank_ifsc),
            'bank_branch'=>$this->whenNotNull($this->bank_branch),
            'admission_no'=>$this->whenNotNull($this->admission_no),
            'admission_date'=>$this->whenNotNull($this->admission_date),
            'campus_id'=>$this->whenNotNull($this->campus_id),
            'academic_session_id'=>$this->academic_session_id,
            'academic_class_id'=>$this->academic_class_id,
            'guardians'=>new UserCollection($this->whenLoaded('guardians')),
            'student_sessions'=>new StudentSessionCollection($this->whenLoaded('student_sessions')),

            'admission'=>[
                'admission_no'=>$this->whenNotNull($this->admission_no),
                'admission_date'=>$this->whenNotNull($this->admission_date),
                'campus_id'=>$this->whenNotNull($this->campus_id),
                'academic_session_id'=>$this->academic_session_id,
                'academic_class_id'=>$this->academic_class_id,
                'academic_session'=>new AcademicSessionResource($this->whenLoaded('academic_session')),
                'academic_class'=>new AcademicClassResource($this->whenLoaded('academic_class')),
                'campus'=>new CampusResource($this->whenLoaded('campus')),
            ],
        ];


        return $data;
    }


}