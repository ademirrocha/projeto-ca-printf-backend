<?php

namespace App\Http\Requests\Api\Project;

use Illuminate\Foundation\Http\FormRequest;

class UpdateRequest extends FormRequest
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

        if($this->hasFile('image')){
            return [
                'id' => ['required', 'integer', 'exists:projects,id'],
                'title' => ['required', 'string'],
                'description' => ['required', 'string'],
                'image' => ['nullable', 'file', 'image', 'max:2048'],

            ];
        }

        return [
            'id' => ['required', 'integer', 'exists:projects,id'],
            'title' => ['required', 'string'],
            'description' => ['required', 'string'],
            'image' => ['nullable'],

        ];
    }

    public function messages(){
        return [
            'image.max' => 'A imagem não pode ser maior que 2MB'
        ];
    }

    
}
