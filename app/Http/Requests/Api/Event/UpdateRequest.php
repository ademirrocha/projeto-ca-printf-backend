<?php

namespace App\Http\Requests\Api\Event;

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
            'id' => ['required', 'integer', 'exists:events,id'],
            'title' => ['required', 'string'],
            'description' => ['required', 'string'],
            'initial_date' => ['required', 'date'],
            'final_date' => ['required', 'date', 'after_or_equal:initial_date'],
            'state' => ['required', 'in:Ativo,Inativo,Cancelado,Em Andamento,Não Iniciado,Concluído'],
        ];
    }

    
}
