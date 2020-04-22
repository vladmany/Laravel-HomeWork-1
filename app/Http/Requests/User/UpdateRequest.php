<?php

namespace App\Http\Requests\User;

use Illuminate\Foundation\Http\FormRequest;

class UpdateRequest extends FormRequest
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
        $id = request()->route('user')->id;

        return [
            'name' => ['required', 'string', 'max:255', 'unique:users'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users,email,' . $id],
            'password' => ['nullable', 'string', 'min:8'],
        ];
    }

    /**
     * @return array
     */
    public function messages()
    {
        return [
            'required' => 'Поле обязательное для заполнения',
            'email' => 'Поле не является email',
            'string' => 'Поле не является строкой',
            'max' => 'Максимально допустимая длинна поля :max символов',
            'min' => 'Минимально допустимая длинна поля :min символов',
            'email.unique' => 'Пользователь с таким email уже зарегистрирован',
            'name.unique' => 'Пользователь с таким именем уже зарегистрирован',
            'year.min' => 'Минимально допустимое значение поля :min',
            'year.max' => 'Минимально допустимое значение поля :max',
        ];
    }
}
