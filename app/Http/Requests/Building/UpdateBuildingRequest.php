<?php

namespace App\Http\Requests\Building;

use Illuminate\Foundation\Http\FormRequest;

class UpdateBuildingRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
   public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name' =>'sometimes|required|string|max:255',
            'code' =>'sometimes|required|string|max:255',
            'campus_id'=>'sometimes|required|numeric|exists:campuses,id',
            'capacity'=>'sometimes|required|numeric'
        ];
    }
}