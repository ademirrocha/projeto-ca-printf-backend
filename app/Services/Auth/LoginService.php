<?php

namespace App\Services\Auth;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
/**
 * Class LoginService
 *
 * @package App\Services\Auth
 */
class LoginService
{

    
    public function __construct()
    {
        
    }


    /**
     * Checks credentials and returns user data and the JWT token or an exception if authentication fails
     *
     * @param array $credentials
     * @return User
     * 
     */
    public function login(array $credentials)
    {

        
        if (Auth::guard('web')->attempt($credentials)) {
            $user = Auth::guard('web')->user();

            return $user;
        }

        return [
            'meta' => [
                'errors' => "Email ou senha incorretos"
            ]
        ];
    }

}