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
            'email'                 => 'required|email',
            'password' => 'required|min:3|max:10',
        ];
    }

    public  function messages()
    {
        return [
            'password.required'                 => 'Vui lòng nhập mật khẩu',
            'password.min'                      => 'Mật khẩu cần lớn hơn :min kí tự',
            'password.max'                      => 'Mật khẩu cần nhỏ hơn :max kí tự',
            'email.required' => 'Vui lòng nhập email',
            'email.email' => 'Email không đúng định dạng',
        ];
    }
}
