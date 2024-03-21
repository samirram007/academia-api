<?php

namespace App\Http\Resources\Department;

use App\Http\Resources\SuccessResource;
use Illuminate\Http\Request;

class DepartmentResource extends SuccessResource
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
        ];
    }
}