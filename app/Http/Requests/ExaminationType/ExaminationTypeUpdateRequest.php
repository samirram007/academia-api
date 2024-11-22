<?php

namespace App\Http\Requests\ExaminationType;

use Illuminate\Foundation\Http\FormRequest;

class ExaminationTypeUpdateRequest extends FormRequest
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
            'examination_type_id'=>['required','exists:examination_types,id'],
            'name'=> ['required','string','max:255']
        ];
    }
}
