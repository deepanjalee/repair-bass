<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class QuotationRequest extends FormRequest
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
            'customer_id' => 'required|exists:customers,id',
            'site_id' => 'required|exists:sites,id',
            'date' => 'required|date',
            'items' => 'required|array',
            'quotation_number' => 'required|string|max:255',
            'discount_type' => 'required|in:1,2',
            'discount_percentage' => 'required_if:discount_type,2|numeric|min:0|max:100',
            'discount' => 'required_if:discount_type,1|numeric|min:0',
            'total' => 'required|numeric|gt:1',
        ];
    }
}
