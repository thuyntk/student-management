<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StudentRequest extends FormRequest
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
        if ($this->route('student')) {
            return [
                'name' => 'required|min:6|max:80|unique:students,name,' . $this->route('student'),
                'email' => 'required|email|unique:students,email,' . $this->route('student'),
                'phone' => 'required|min:10|max:15,' . $this->route('student'),
                'avatar' => 'required',
                'address' => 'required',
                'birthday' => 'required',
                'gender' => 'required',
                'faculty_id' => 'required',
            ];
        }

        return [
            'name' => 'required|min:6|max:80|unique:students,name',
            'email' => 'required|email|unique:students,email',
            'phone' => 'required|min:10|max:15',
            'avatar' => 'required',
            'address' => 'required',
            'birthday' => 'required',
            'gender' => 'required',
            'faculty_id' => 'required',
        ];
    }
}
