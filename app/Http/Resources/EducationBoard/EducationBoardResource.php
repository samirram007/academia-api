<?php

namespace App\Http\Resources\EducationBoard;

use App\Http\Resources\Address\AddressResource;
use App\Http\Resources\SuccessResource;
use Illuminate\Http\Request;

class EducationBoardResource extends SuccessResource
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
            'contact_no' => $this->whenNotNull($this->contact_no),
            'email' => $this->whenNotNull($this->email),
            'description' => $this->whenNotNull($this->description),
            'website' => $this->whenNotNull($this->website),
            'establishment_date' => $this->whenNotNull($this->establishment_date),
            'logo_image_id' => $this->whenNotNull($this->logo_image_id),
        ];
    }
}
