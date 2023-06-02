<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SignUpRequest extends FormRequest
{
    public function rules()
    {
        return [
            'name' => ['required', 'regex:/^[а-яёА-ЯЁ\s\-]+$/iu'],
            'surname' => ['required', 'regex:/^[а-яёА-ЯЁ\s\-]+$/iu'],
            'patronymic' => ['regex:/^[а-яёА-ЯЁ\s\-]+$/iu', 'nullable'],
            'email' => ['required', 'unique:users', 'email'],
            'telephone' => ['required'],
            'image' => ['image', 'nullable'],
            'login' => ['required', 'unique:users', 'regex:/^[a-z\d\-]+$/i'],
            'password' => ['required', 'regex:/^(?=.*[A-Z])(?=.*[0-9])(?=.*[!&#?])[0-9a-zA-Z!#&?]{6,}$/', 'confirmed']
        ];
    }

    public function messages()
    {
        return [
            'required'=>'Поле ":attribute" необходимо заполнить',
            'unique'=>':attribute должно(-а) быть уникальным',
            'regex'=>':attribute не соответствует шаблону',
            'email'=>'":attribute" должно(-а) быть валидным',
            'confirmed'=>'Пароли не совпадают'
        ];
    }

    public function attributes() {
        return [
            'name'=>'Имя',
            'surname'=>'Фамилия',
            'patronymic'=>'Отчество',
            'email' => 'Электронная почта',
            'telephone' => 'Номер телефона',
            'image' => 'Фотография',
            'login'=>'Логин',
            'password'=>'Пароль'
        ];
    }
}
