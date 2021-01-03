<?php

namespace App\Http\Requests\Api\Event;

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
            'description' => ['required', 'string'],
            'initial_date' => ['required', 'date'],
            'final_date' => ['required', 'date', 'after_or_equal:initial_date'],
            'state' => ['in:Ativo,Inativo,Cancelado'],
        ];
    }

    
}
