<?php

namespace App\Http\Requests\Floor;

use Illuminate\Foundation\Http\FormRequest;

class UpdateFloorRequest extends FormRequest
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
            'name' => ['sometimes', 'string','max:255'],
            'code' => ['sometimes', 'string','max:20'],
            'capacity' => ['sometimes', 'numeric'],
            'building_id'=>['sometimes','numeric','exists:buildings,id'],
        ];
    }
}
