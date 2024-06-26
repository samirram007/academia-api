<?php

namespace App\Http\Requests\AcademicStandard;

use Illuminate\Foundation\Http\FormRequest;

class StoreAcademicStandardRequest extends FormRequest
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
            'code' => ['sometimes','nullable','string','max:20'],
            'description'=>['sometimes','nullable','string']
        ];
    }
}
