<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class QuotatioStorenRequest extends FormRequest
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
            'customer_id' => 'required',
            'site_id' => 'required',
            'date' => 'required',
            'discount_type' => 'required',
            'total' => 'required',
            'sub_total' => 'required',
            'items' => "array"
        ];
    }
}
