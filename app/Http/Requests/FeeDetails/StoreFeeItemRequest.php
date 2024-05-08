<?php

namespace App\Http\Requests\FeeItem;

use Illuminate\Foundation\Http\FormRequest;

class StoreFeeItemsRequest extends FormRequest
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
            'fee_id' => ['required', 'exists:fees,id'],
            'fee_head_id'=> ['required', 'exists:fee_heads,id'],
            'amount' => ['required', 'numeric'],
            'no_of_months'=> ['sometimes','required', 'integer'],
            'monthly_fee_amount'=> ['sometimes','required', 'numeric'],
            'months'=> ['sometimes','required', 'array'],
        ];
    }
}
