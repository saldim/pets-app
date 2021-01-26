<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StorePetRequest extends FormRequest
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
     * Правила валидации запроса на добавление питомца.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'full_name' => 'required|max:255',
            'phone' => 'required|integer',
            'breed' => 'required|max:255',
            'nickname' => 'required|max:255',
            'age' => 'required|integer',
        ];
    }
}
