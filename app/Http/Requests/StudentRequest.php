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
        return false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'name' => 'required|min:4|max:80',
            'email' => 'required|email|unique:users,email',
            'phone' => 'required|min:11|max:15',
            'avatar' => 'required',
            'address' => 'required',
            'birthday' => 'required',
            'gender' => 'required',
        ];
    }
}
