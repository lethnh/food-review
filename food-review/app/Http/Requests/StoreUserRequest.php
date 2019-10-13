<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Http\JsonResponse;
use Illuminate\Validation\ValidationException;

class StoreUserRequest extends FormRequest
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
            'email'                 => 'required|email|unique:users,email',
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
            'email.required' => 'Vui lòng nhập email',
            'email.email' => 'Email không đúng định dạng',
            'email.unique' => 'Email đã tồn tại',
            'password_confirmation.required' => 'Vui lòng nhập lại mật khẩu',
        ];
    }

    protected function failedValidation(Validator $validator)
    {

        $errors = (new ValidationException($validator))->errors();
        // throw new \Exception($errors);
        throw new HttpResponseException(response()->json(
            [
                'error' => $errors,
                'status_code' => 422,
            ],
            JsonResponse::HTTP_UNPROCESSABLE_ENTITY
        ));
    }
}
