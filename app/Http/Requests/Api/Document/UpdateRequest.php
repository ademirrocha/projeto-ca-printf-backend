<?php

namespace App\Http\Requests\Api\Document;

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

        
        if($this->hasFile('file')){
            return [
                'id' => ['required', 'integer', 'exists:documents,id'],
                'title' => ['required', 'string'],
                'file' => ['required', 'file', 'mimes:pdf', 'max:10240'],
            ];
        }


        return [
            'id' => ['required', 'integer', 'exists:documents,id'],
            'title' => ['required', 'string'],
            'file' => ['nullable'],
        ];


    }


    
}
