<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

use App\Models\User;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        if(!User::where('email', 'admin@centro-academico-bsi-ifnmg-arinos.com')->exists()){
            $user = User::create([
                'name' => 'Administrador do site',
                'email' => 'admin@centro-academico-bsi-ifnmg-arinos.com',
                'password' => Hash::make('admin588335678'),
            ]);

            $user->assignRole('admin');
        }
    }
}
