<?php

namespace App\Http\Requests\FeeTemplate;

use Illuminate\Foundation\Http\FormRequest;

class StoreFeeTemplateRequest extends FormRequest
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
            'name' => ['required','string','max:255'],
            'is_active'=>'sometimes|boolean',
            'academic_year_id'=>'required|exists:academic_years,id',
            'academic_class_id'=>'required|exists:academic_classes,id'
        ];
    }
}
