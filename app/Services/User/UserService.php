<?php

namespace App\Services\User;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;

/**
 * Class UserService
 *
 * @package App\Services\User
 */
class UserService
{

    /**
     * UserService constructor.
     *
     */
    public function __construct()
    {
        //
    }


    
    /**
     * #UserCreate-CaseUse
     * @param array $data
     * @return User
     */

    public function create(array $data): User
    {
        return DB::transaction(function () use ($data) {

            $user = User::create([
                'name' => $data['name'],
                'email' => $data['email'],
                'password' => Hash::make($data['password']),
            ]);

            $user->assignRole('user');

            return $user;
        });
    }

    /**
     * #UpdateUser.
     * @param array $data
     * @return User
     */
    public function update(array $data): User
    {

        return DB::transaction(function () use ($data) {

            if(isset($data['password'])){
                $newPassword = Hash::make($data['password']);
            }

            $user = User::find(auth()->user()->id);

            $user->name = $data['name'];
            $user->email = $data['email'];
            $user->password = $newPassword ?? $user->password;

            return $user;

        });

    }

    
    public function getAdmin(){
        return $this->userRepository->getAdmin();
    }

    
}