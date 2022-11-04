<?php

namespace App\Http\Requests\Api;

use Illuminate\Foundation\Http\FormRequest;

class RecordDeleteRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        $array = [
            'id' => 'required|exists:records,id_record|numeric',
        ];

        return $array;
    }

    public function attributes()
    {
        return [
            'id' => 'id do lançamento',
        ];
    }

    /**
     * Custom message for validation
     *
     * @return array
     */
    public function messages()
    {
        return [
            '*.required' => 'O :attribute é obrigatório!',
            '*.exists' => 'O :attribute não foi encontrado!'
        ];
    }
}