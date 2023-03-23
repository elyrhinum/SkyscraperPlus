<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ModeratorUpdateRequest extends FormRequest
{
    public function rules()
    {
        return [
            'name' => ['required', 'regex:/^[а-яёА-ЯЁ\s\-]+$/iu'],
            'surname' => ['required', 'regex:/^[а-яёА-ЯЁ\s\-]+$/iu'],
            'patronymic' => ['regex:/^[а-яёА-ЯЁ\s\-]+$/iu', 'nullable'],
            'login' => ['required', 'regex:/^[a-z\d\-]+$/i']
        ];
    }

    public function messages()
    {
        return [
            'required'=>'Поле ":attribute" необходимо заполнить',
            'unique'=>':attribute должно(-а) быть уникальным',
            'regex'=>':attribute не соответствует шаблону',
        ];
    }

    public function attributes() {
        return [
            'name'=>'Имя',
            'surname'=>'Фамилия',
            'patronymic'=>'Отчество',
            'login'=>'Логин',
        ];
    }
}
