<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateStudentinfoRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'grade_id' => 'nullable|exists:grades,id',
            'classroom_id' => 'nullable|exists:classrooms,id',
            'section_id' => 'nullable|exists:sections,id',
            'Nationality' => 'nullable|between:2,100',
        ];
    }
}
