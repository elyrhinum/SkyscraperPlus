<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class DocumentRequest extends FormRequest
{
    public function rules()
    {
        return [
            'name' => 'required | unique:documents',
        ];
    }

    public function messages()
    {
        return [
            'required' => 'Поле :attribute обязательно для заполнения',
            'unique' => 'Такой документ уже существует'
        ];
    }

    public function attributes()
    {
        return [
            'name' => 'Наименование',
        ];
    }
}
