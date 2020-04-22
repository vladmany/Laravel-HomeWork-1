<?php

namespace App\Http\Requests\Book;

use Illuminate\Foundation\Http\FormRequest;

class UploadRequest extends FormRequest
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
            'preview' => 'required|image|max:100',
            'body' => 'required|file|mimes:xml',
            'title' => 'bail|required|string|max:58|unique:App\Models\Book',
            'annotation' => 'required|string|max:2000',
            'author' => 'required|string|max:30',
            'year' => 'required|integer|min:868|max:2100',
        ];
    }

    /**
     * @return array
     */
    public function messages()
    {
        return [
            'required' => 'Поле обязательное для заполнения',
            'image' => 'Загруженный файл не является картинкой',
            'preview.max' => 'Максимальный размер картинки :max КБ',
            'string' => 'Поле не является строкой',
            'max' => 'Максимально допустимая длинна поля :max символов',
            'min' => 'Минимально допустимая длинна поля :min символов',
            'title.unique' => 'Книга с таким названием уже существует',
            'year.min' => 'Минимально допустимое значение поля :min',
            'year.max' => 'Минимально допустимое значение поля :max',
            'integer' => 'Поле не является числом'
        ];
    }

    /**
     * @return array
     */
    public function attributes()
    {
        return [

        ];
    }
}
