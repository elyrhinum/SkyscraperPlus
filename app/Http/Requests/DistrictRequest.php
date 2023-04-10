<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class DistrictRequest extends FormRequest
{
    public function rules()
    {
        return [
            'name' => 'required | unique:districts',
        ];
    }

    public function messages()
    {
        return [
            'required' => 'Поле :attribute обязательно для заполнения',
            'unique' => 'Такой район уже существует'
        ];
    }

    public function attributes()
    {
        return [
            'name' => 'Наименование',
        ];
    }
}
