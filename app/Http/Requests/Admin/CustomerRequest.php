<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class CustomerRequest extends FormRequest
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
        switch ($this->method()) {
            case 'GET':
            case 'DELETE':
                return [];
            case 'POST':
                return [
                    'full_name' => 'required',
                    'email' => 'nullable|unique:customers,email',
                ];
            case 'PUT':

            case 'PATCH':
                return [
                    'full_name' => 'required',
                    'email' => 'required|unique:customers,email,'.$this->id,
                ];
            default:
                break;
        }

        return [];
    }
}
