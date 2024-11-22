<?php

namespace App\Http\Requests\Examination;

use Illuminate\Foundation\Http\FormRequest;

class ExaminationUpdateRequest extends FormRequest
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
            'name'=> ['string','max:255'],
            'examination_types_id'=> ['required','numeric'],
            'examination_start_date'=> ['required','date'],
            'examination_end_date'=>['required','date'],
            'academic_session_id' => ['required','numeric'],
            'campus_id'=> ['required','numeric']
        ];
    }
}
