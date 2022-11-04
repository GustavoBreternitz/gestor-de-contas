<?php

namespace App\Http\Requests\Api;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
class RecordCreateRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        $array = [
            'title' => 'required_without:create|max:200',
            'value' => 'required_without:create|numeric',
            'type' => 'required_without:create|integer',
            'id_class' => 'required_without:create|integer',
            'create' => 'array',
            'create.*.title' => ['max:200', 
            Rule::RequiredIf(function () {
                return is_array(request()->get('create'));
             })],            
             'create.*.value' => ['numeric', 
            Rule::RequiredIf(function () {
                return is_array(request()->get('create'));
             })],            
             'create.*.type' => ['integer', 
            Rule::RequiredIf(function () {
                return is_array(request()->get('create'));
             })],            
             'create.*.id_class' => ['integer', 
            Rule::RequiredIf(function () {
                return is_array(request()->get('create'));
             })],

        ];

        return $array;
    }

    public function attributes()
    {
        return [
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
            '*.required_without' => 'O :attribute é obrigatório!',
            'create.array' => 'Para a criação de diversos lançamentos simultâneos, é necessário conter todas as keys básicas para o mesmo.'
        ];
    }
}