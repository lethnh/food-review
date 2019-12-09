<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ChangePasswordRequest extends FormRequest
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
            'password'              => 'required|min:6|max:255',
            'password_confirmation' => 'required|min:6|max:255|same:password',
        ];
    }
    public  function messages()
    {
        return [
            'password.required'                 => 'Vui lòng nhập mật khẩu',
            'password.min'                      => 'Mật khẩu cần lớn hơn :min kí tự',
            'password.max'                      => 'Mật khẩu cần nhỏ hơn :max kí tự',
            'password_confirmation.required'    => 'Vui lòng nhập mật khẩu',
            'password_confirmation.min'         => 'Mật khẩu cần lớn hơn :min kí tự',
            'password_confirmation.max'         => 'Mật khẩu cần nhỏ hơn :max kí tự',
            'password_confirmation.same'        => 'Mật khẩu không khớp nhau',
        ];
    }
}
