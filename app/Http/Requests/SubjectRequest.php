<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SubjectRequest extends FormRequest
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
            'name' => 'required|unique:subjects|min:4|max:80',
        ];
    }
    public function messages()
    {
        return [
            'name.required' => 'Required to enter subject name',
            'name.unique' => 'Subject name already exists',
            'name.min' => 'The minimum length of the subject name is 6 characters',
            'name.max' => 'The maximum length of the subject name is 80 characters',

        ];
    }
}
