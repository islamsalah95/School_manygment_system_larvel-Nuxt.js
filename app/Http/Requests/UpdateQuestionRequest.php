<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateQuestionRequest extends FormRequest
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
            'question' => 'nullable|string',
            'A' => 'nullable|string',
            'B' => 'nullable|string',
            'C' => 'nullable|string',
            'D' => 'nullable|string',
            'correct' => 'nullable|string',
            'score' => 'nullable|string',
            'exam_id ' => 'nullable|exists:exams,id',
        ];
    }
}
