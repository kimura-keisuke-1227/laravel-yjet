<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Models\Subcontractor as Subcontractor;

class StoreSubcontractorRequest extends FormRequest
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
            Subcontractor::CLM_NAME_OF_SUBCONTRACTOR_NAME  => "required",
            Subcontractor::CLM_NAME_OF_SUBCONTRACTOR_CODE => "required",
            Subcontractor::CLM_NAME_OF_SUBCONTRACTOR_ABBREVIATION => "",
        ];
    }
}
