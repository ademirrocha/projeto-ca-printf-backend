<?php

namespace App\Http\Requests\Api\ContentText;

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
        //return Auth::check();
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
            'content' => ['required', 'string'],
            'newText' => ['required_without:image', 'string'],
            'type' => ['nullable', 'in:text,image'],
            'image' => ['required_without:newText' , 'array'],
            'image.originalName' => ['nullable', 'string'],
            'image.size' => ['required_with:image', 'integer', 'between:2,'. (5 * 1024 * 1024)],
            'image.mimetype' => ['required_with:image', 'string'],
            'image.key' => ['required_with:image', 'string'],
            'image.url' => ['required_with:image', 'url'],
            'image.url_download' => ['nullable', 'url'],
        ];
    }

    public function messages(){
        return [
            'image.size.between' => 'Arquivo não pode ser maior que 5MB',
            'newText.required_without' => 'Obrigatório o envio do conteúdo',
            'image.required_without' => 'Obrigatório o envio do conteúdo'
        ];
    }


    
}
