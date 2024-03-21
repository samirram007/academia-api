<?php

namespace App\Http\Resources\AcademicYear;

use App\Http\Resources\SuccessResource;
use Illuminate\Http\Request;

class AcademicYearResource extends SuccessResource
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
            'campus_id' => $this->campus_id,
            'year' => $this->whenNotNull($this->year),
            'start_date' => $this->whenNotNull($this->start_date),
            'end_date' => $this->whenNotNull($this->end_date),
            'previous_academic_year_id' => $this->whenNotNull($this->previous_academic_year_id),
            'next_academic_year_id' => $this->whenNotNull($this->next_academic_year_id),
            'is_current' => $this->whenNotNull($this->is_current),
            'campus'=> $this->whenNotNull($this->campus),
        ];
    }
}
