<?php

namespace App\Http\Requests\Api\Project;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class UpdateRequest extends FormRequest
{


    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return Auth::check();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {

        return [
            'id' => ['required', 'integer', 'exists:projects,id'],
            'title' => ['required', 'string'],
            'description' => ['required', 'string'],
            'image' => ['nullable' , 'array'],
            'image.originalName' => ['nullable', 'string'],
            'image.size' => ['required_with:image', 'integer', 'between:2,'. (2 * 1024 * 1024)],
            'image.mimetype' => ['required_with:image', 'string'],
            'image.key' => ['required_with:image', 'string'],
            'image.url' => ['required_with:image', 'url'],
            'image.url_download' => ['nullable', 'url'],
            'state' => ['in:Ativo,Inativo,Cancelado,Em Andamento,Não Iniciado,Concluído'],
        ];
    }

    public function messages(){
        return [
            'image.size.between' => 'A imagem não pode ser maior que 2MB'
        ];
    }

    
}
