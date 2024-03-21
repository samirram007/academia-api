<?php

namespace App\Http\Requests\AcademicYear;

use Illuminate\Foundation\Http\FormRequest;

class UpdateAcademicYearRequest extends FormRequest
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
            'campus_id' => ['required', 'numeric', 'exists:campuses,id'],
            'year' => ['sometimes', 'required'],
            'start_date' => ['sometimes', 'nullable', 'date'],
            'end_date' => ['sometimes', 'nullable', 'date', 'after:start_date'],
            'previous_academic_year_id' => ['sometimes', 'nullable', 'numeric', 'exists:academic_years,id'],
            'next_academic_year_id' => ['sometimes', 'nullable', 'numeric', 'exists:academic_years,id'],
            'is_current' => ['sometimes', 'nullable', 'boolean'],
        ];
    }
}
