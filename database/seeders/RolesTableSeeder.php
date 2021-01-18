<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Role;
use App\Models\User;

class RolesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::transaction(function () {
            foreach (Role::all() as $role) {
                $role->delete();
            }

            $max = DB::table('roles')->max('id') + 1; 
            DB::statement("ALTER TABLE roles AUTO_INCREMENT =  $max");

            $roles = [
                'user',
                'admin',
                'moderator',
            ];

            foreach ($roles as $role) {
                Role::create(['name' => $role, 'guard_name' => 'api']);
            }


            foreach (User::all() as $user) {
                $user->assignRole('user');
            }

        });
    }
}
