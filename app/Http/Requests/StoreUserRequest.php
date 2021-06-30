<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

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
            'name' => 'required',
            'password' => 'required',
            'email' => 'required|unique:users,email',
        ];
    }
    public function messages()
    {
        return [
            'name.required' => 'Trường Name bắt buộc nhập',
            'password.required' => 'Trường password bắt buộc nhập',
            'email.required' => 'Trường Email bắt buộc nhập',
            'email.unique' => 'Mail này đã tồn tại',
        ];
    }
}
