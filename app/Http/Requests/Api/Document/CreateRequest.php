<?php

namespace App\Http\Requests\Api\Document;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class CreateRequest extends FormRequest
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
            'title' => ['required', 'string'],
            'description' => ['nullable', 'string'],
            'school_class' => ['nullable'],
            'type' => ['nullable'],
            'state' => ['nullable'],
            'file' => ['required' , 'array'],
            'file.originalName' => ['nullable', 'string'],
            'file.size' => ['required_with:file', 'integer', 'between:2,'. (10 * 1024 * 1024)],
            'file.mimetype' => ['required_with:file', 'string'],
            'file.key' => ['required_with:file', 'string'],
            'file.url' => ['required_with:file', 'url'],
        ];
    }

    public function messages(){
        return [
            'file.size.between' => 'Arquivo não pode ser maior que 10MB'
        ];
    }

    
}
