<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserRequest extends FormRequest
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
     * @return array
     */
    public function rules()
    {
        return [
            'email' => 'required|email|unique:users',
            'password' => 'required|min:5|max:255',
        ];
    }

    public  function messages()
    {
        return [
            'email.required' => 'Please enter email',
            'email.email' => 'Enter the correct email format',
            'email.unique' => 'Email already exists',

            'password.required' => 'Please enter a password',
            'password.min' => 'Password needs to be greater than: min characters',
            'password.max' => 'Password needs to be smaller: max characters',
        ];
    }
}
