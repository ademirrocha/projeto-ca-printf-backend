<?php

namespace App\Http\Requests\Api\User;

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
       
       $email = $this->user()->email;   
       return [
        'name' => ['required', 'string', 'min:3'],
        'email' => ['required', 'email', "unique:users,email,$email,email"],
        'password' => ['nullable', 'string', 'confirmed', 'min:8'],
        'password_old' => ['required']
    ];
}


}
