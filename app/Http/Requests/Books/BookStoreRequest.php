<?php

namespace App\Http\Requests\Books;

use Illuminate\Foundation\Http\FormRequest;

class BookStoreRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return 1;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'author' => 'required',
            'title' => 'required',
            'seria' => 'required'
        ];
    }

    public function messages()
    {
        return [
            'author.required' => 'Поле [Автор] обязательное к заполению',
            'title.required'  => 'Поле [Название] обязательное к заполению',
            'seria.required'  => 'Поле [Серия] обязательное к заполению'
        ];
    }
}
