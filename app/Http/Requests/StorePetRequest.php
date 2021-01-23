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
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            //'owner_id' => 'required|exists:owners,id',
            'full_name' => 'required|max:255',
            'phone' => 'required|max:20',
            'breed' => 'required|max:255',
            'nickname' => 'required|max:255',
            'age' => 'required|integer',
        ];
    }
}
