<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Models\Customer as Customer;

class UpdateCustomerRequest extends FormRequest
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
            Customer::CLM_NAME_OF_CUSTOMER_CODE => 'required|string|max:100',
            Customer::CLM_NAME_OF_CUSTOMER_NAME => 'required|string|max:100',
            Customer::CLM_NAME_OF_CUSTOMER_OFFICIAL_NAME => 'nullable|string|max:200',
            Customer::CLM_NAME_OF_TRANSFER_MONTH => 'nullable|integer|min:1|max:12',
            Customer::CLM_NAME_OF_TRANSFER_DAY => 'nullable|integer|min:1|max:31',
        ];
    }
}
