<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

use App\Models\Project as Project;

class UpdateProjectRequest extends FormRequest
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
            Project::CLM_NAME_OF_PROJECT_NAME => "required",
            Project::CLM_NAME_OF_START_DATE => "required::date",
            Project::CLM_NAME_OF_END_DATE => "",
            Project::CLM_NAME_OF_USER_ID => "",
            Project::CLM_NAME_OF_REMARK => "",
            Project::CLM_NAME_OF_IS_EXPIRE=> "",
        ];
    }
}
