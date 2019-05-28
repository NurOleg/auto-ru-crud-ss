<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreAdvert extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
//        return false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name' => 'required|max:255',
            'year' => 'required|min:4|max:4',
            'engine_id' => 'required',
            'mark_id' => 'required',
            'transmission_id' => 'required',
        ];
    }

    /**
     * @return array
     */
    public function messages()
    {
        return [
            'name.required' => 'Поле "Название" обязательно для заполнения',
            'name.max' => 'Поле "Название" не может быть длиннее 255 символов',
            'year.required' => 'Поле "Год выпуска" обязательно для заполнения',
            'year.min' => 'Длина поля "Год выпуска" должна быть равна четырём символам',
            'year.max' => 'Длина поля "Год выпуска" должна быть равна четырём символам',
            'engine_id.required' => 'Поле "Тип двигателя" обязательно для заполнения',
            'mark_id.required' => 'Поле "Марка" обязательно для заполнения',
            'transmission_id.required' => 'Поле "Коробка передач" обязательно для заполнения',
        ];
    }
}
