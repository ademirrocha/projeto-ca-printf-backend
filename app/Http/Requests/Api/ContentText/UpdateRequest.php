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
            'newText' => ['required', 'string'],
            'type' => ['nullable', 'in:text,image'],
            'file' => ['nullable' , 'array'],
            'file.originalName' => ['nullable', 'string'],
            'file.size' => ['required_with:file', 'integer', 'between:2,'. (5 * 1024 * 1024)],
            'file.mimetype' => ['required_with:file', 'string'],
            'file.key' => ['required_with:file', 'string'],
            'file.url' => ['required_with:file', 'url'],
            'file.url_download' => ['nullable', 'url'],
        ];
    }

    public function messages(){
        return [
            'file.size.between' => 'Arquivo não pode ser maior que 5MB'
        ];
    }


    
}
