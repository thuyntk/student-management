<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class FacultyRequest extends FormRequest
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
            'name'=> 'required|unique:faculties|min:6',
        ];
    }
    public function messages()
    {
        return [
            'name.required' => 'Required to enter faculty name',
            'name.unique' => 'Faculty name already exists',
            'name.min' => 'The minimum length of the faculty name is 6 characters',
        ];
    }
}
