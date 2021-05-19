<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreRequest extends FormRequest
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
            'name'           => 'required',
            'description'    => 'required|min:10', //Campo obrigatório, com no minimo 10 caracteres
            'phone'          => 'required',
            'mobile_phone'   => 'required',
            'logo'           => 'image',
        ];
    }

    public function messages(){
        
        return[
            'required' => 'O campo :attribute é obrigatório',
            'min' => 'O campo deve ter no mínimo :min caracteres',
            'image' => 'Arquivo não é uma imagem valida'
        ];
    }
}