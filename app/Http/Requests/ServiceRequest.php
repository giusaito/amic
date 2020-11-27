<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;

class ServiceRequest extends FormRequest
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
        // $id = \request()->segment(3);

        $rules = [
            'content' => 'required|min:12',
            'title' => 'required|min:3'
        ];

        return $rules;
    }

    public function messages()
    {
        return [
            'content.required' => 'O campo "Conteúdo" é obrigatório',
            'content.min' => 'O Conteúdo precisa ter no mínimo doze caracteres',
            'title.required' => 'O campo "Título" é obrigatório',
            'title.min' => 'O título precisa ter no mínimo três caracteres',
        ];
    }
}
