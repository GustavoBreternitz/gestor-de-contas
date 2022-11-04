<?php

namespace App\Http\Requests\Api;

use Illuminate\Foundation\Http\FormRequest;

class RecordUpdateRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        $array = [
            'id' => 'required|exists:records,id_record|numeric',
            'title' => 'required|max:200',
            'value' => 'required|numeric',
            'type' => 'required|integer',
            'id_class' => 'required|integer'
        ];

        return $array;
    }

    public function attributes()
    {
        return [
            'id' => 'id do lançamento',
            'title' => 'titulo do lançamento',
            'value' => 'valor do lançamento',
            'type' => 'tipo do lançamento',
            'id_class' => 'classificação do lançamento'
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