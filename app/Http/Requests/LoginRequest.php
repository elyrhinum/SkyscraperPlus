<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class LoginRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'login' => 'required | exists:users',
            'password' => 'required',
        ];
    }

    public function messages()
    {
        return [
            'required' => ':attribute обязательно для заполнения',
            'exists' => 'Такого пользователя не существует'

        ];
    }

    public function attributes()
    {
        return [
            'login' => 'Логин',
            'password' => 'Пароль'
        ];
    }
}
