<?php

namespace App\Http\Requests\Fee;

use Illuminate\Foundation\Http\FormRequest;

class UpdateFeeRequest extends FormRequest
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
            'fee_no'=> ['sometimes','required','string','max:255'],
            'fee_date'=> ['sometimes','required', 'date'],
            'fee_template_id'=> ['sometimes','required', 'exists:fee_templates,id'],
            'student_id' =>  ['sometimes','required','number', 'exists:students,id'],
            'academic_session_id'=> ['sometimes','required', 'exists:academic_sessions,id'],
            'academic_class_id'=> ['sometimes','required', 'exists:academic_classes,id'],
            'total_amount'=> ['sometimes','required', 'numeric'],
            'paid_amount'=> ['sometimes','required', 'numeric'],
            'balance_amount'=> ['sometimes','required', 'numeric'],
            'payment_mode'=> ['sometimes','required','string','max:255'],
            'fee_items'=> ['sometimes','required', 'array'],
            'fee_items.*.id'=> ['sometimes','required', 'exists:fee_items,id'],
            'fee_items.*.fee_id'=> ['sometimes','required', 'exists:fees,id'],
            'fee_items.*.fee_head_id'=> ['required', 'exists:fee_heads,id'],
            'fee_items.*.no_of_months'=> ['sometimes','required', 'numeric'],
            'fee_items.*.monthly_fee_amount'=> ['sometimes','required', 'numeric'],
            'fee_items.*.months'=> ['sometimes','required', 'array'],
            'fee_items.*.amount'=> ['required', 'numeric'],
        ];
    }
}
