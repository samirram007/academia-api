<?php

namespace App\Http\Requests\Fee;

use Illuminate\Foundation\Http\FormRequest;

class StoreFeeRequest extends FormRequest
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
            'fee_no'=> ['required','string','max:255'],
            'fee_date'=> ['required', 'date'],
            'fee_template_id'=> ['required', 'exists:fee_templates,id'],
            'student_id' =>  ['required','number', 'exists:students,id'],
            'academic_year_id'=> ['required', 'exists:academic_years,id'],
            'academic_class_id'=> ['required', 'exists:academic_classes,id'],
            'total_amount'=> ['required', 'numeric'],
            'paid_amount'=> ['sometimes','required', 'numeric'],
            'balance_amount'=> ['sometimes','required', 'numeric'],
            'payment_mode'=> ['sometimes','required','string','max:255'],
            'fee_details'=> ['sometimes','required', 'array'],
            'fee_details.*.fee_head_id'=> ['required', 'exists:fee_heads,id'],
            'fee_details.*.no_of_months'=> ['sometimes','required', 'numeric'],
            'fee_details.*.monthly_fee_amount'=> ['sometimes','required', 'numeric'],
            'fee_details.*.months'=> ['sometimes','required', 'array'],
            'fee_details.*.amount'=> ['required', 'numeric'],

        ];
    }


}
