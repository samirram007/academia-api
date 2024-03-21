<?php

namespace App\Http\Resources\School;

use App\Http\Resources\Address\AddressResource;
use App\Http\Resources\Document\DocumentResource;
use App\Http\Resources\EducationBoard\EducationBoardResource;
use App\Http\Resources\SchoolType\SchoolTypeResource;
use App\Http\Resources\SuccessResource;
use Illuminate\Http\Request;

class SchoolResource extends SuccessResource
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
            'code' => $this->whenNotNull($this->code),
            'address' => new AddressResource($this->whenLoaded('address')),
            'education_board' => new EducationBoardResource($this->whenLoaded('education_board')),
            'contact_no' => $this->whenNotNull($this->contact_no),
            'email' => $this->whenNotNull($this->email),
            'website' => $this->whenNotNull($this->website),
            'establishment_date' => $this->whenNotNull($this->establishment_date),
            'school_type' => new SchoolTypeResource($this->whenLoaded('school_type')),
            'logo_image' => new DocumentResource($this->whenLoaded('logo_image')),

        ];
    }
}
