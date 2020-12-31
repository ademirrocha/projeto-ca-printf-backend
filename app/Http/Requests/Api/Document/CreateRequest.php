<?php

namespace App\Http\Requests\Api\Document;

use Illuminate\Foundation\Http\FormRequest;

class CreateRequest extends FormRequest
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
            'title' => ['required', 'string'],
            'file' => ['required', 'file', 'mimes:pdf', 'max:10240'],
        ];
    }

    public function messages(){
        return [
            'file.max' => 'Arquivo não pode ser maior que 10MB'
        ];
    }

    
}
