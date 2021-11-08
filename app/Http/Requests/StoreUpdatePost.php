<?php

namespace App\Http\Requests;

use Illuminate\Validation\Rule;
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
        //Essa linha pega o 2° segmento da url, no caso o id
        //ele baseia na url passada no form
        $id = $this->segment(2);

        $rules = [
            //'title' => "required|min:3|max:160|unique:posts,title,{$id},id",
            //ele é unico na tabela posts no campo title, onde $id é diferente do campo id
            //isso faz ele ignorar o proprio post, senao ia dar duplicado sempre

            'title' => ['required',
                        'min:3',
                        'max:160',
                        Rule::unique('posts')->ignore($id)
                    ],

            'content' => ['nullable','min:5','max:1000'],
            //o laravel tem o atributo image q ja valida se o arquivo é uma imagem
            //Aqui pode validar o peso da imagem, e as dimensoes tambem
            'image' => ['required', 'image'],
        ];

        //verifica se é o update, pq n precisa atualizar a imagem se nao quiser
        if ($this->method() == 'PUT') {
            //Aqui duplica tudo da imagem
            $rules['image'] = ['nullable', 'image'];
        }

        return $rules;
    }
}
