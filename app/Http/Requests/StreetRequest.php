<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StreetRequest extends FormRequest
{
    public function rules()
    {
        return [
            'name' => 'required | unique:streets',
        ];
    }

    public function messages()
    {
        return [
            'required' => 'Поле :attribute обязательно для заполнения',
            'unique' => 'Такая улица уже существует'
        ];
    }

    public function attributes()
    {
        return [
            'name' => 'Наименование',
        ];
    }
}
