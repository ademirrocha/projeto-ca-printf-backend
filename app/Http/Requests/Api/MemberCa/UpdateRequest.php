<?php

namespace App\Http\Requests\Api\MemberCa;

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
            'president' => ['nullable', 'string'],
            'vice_president' => ['nullable', 'string'],
            'secretary' => ['nullable', 'string'],
            'treasurer' => ['nullable', 'string'],
            'communication_coordinator' => ['nullable', 'string'],
            'events_coordinator' => ['nullable', 'string'],
            
        ];
    }
    
}
