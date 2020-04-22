<?php

namespace App\Http\Requests\Auth;

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
            'old-password' => ['required','password'],
            'password' => ['required', 'string', 'min:8', 'confirmed']
        ];
    }

    public function messages()
    {
        return [
            'required' => 'Поле обязательное для заполнения',
            'password' => 'Неверный пароль',
            'confirmed' => 'Пароли не совпадают',
            'string' => 'Поле не является строкой',
            'min' => 'Минимально допустимая длинна поля :min символов',
        ];
    }
}
