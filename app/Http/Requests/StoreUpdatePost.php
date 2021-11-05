<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreUpdatePost extends FormRequest
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
            'title' => 'required|min:3|max:160',
            'content' => ['nullable','min:5','max:1000'],
            //o laravel tem o atributo image q ja valida se o arquivo é uma imagem
            //Aqui pode validar o peso da imagem, e as dimensoes tambem
            'image' => ['required', 'image'],
        ];
    }
}
