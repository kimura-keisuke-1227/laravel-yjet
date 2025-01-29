<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

use App\Models\ReportHeader;

class StoreReportHeaderRequest extends FormRequest
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
            ReportHeader::CLM_NAME_OF_REPORT_CODE => 'required',
            ReportHeader::CLM_NAME_OF_REPORT_NAME => 'required',
            ReportHeader::CLM_NAME_OF_REPORT_REMARK => '',
        ];
    }
}
