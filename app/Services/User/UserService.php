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
     * #UserUpdate-CaseUse.
     * @param User $user
     * @param array $data
     * @return User
     */
    public function update(User $user, array $data): User
    {
        return $this->userRepository->update($user, $data);
    }

    
    public function getAdmin(){
        return $this->userRepository->getAdmin();
    }

    
}