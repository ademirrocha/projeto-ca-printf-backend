<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Role;

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

            $roles = [
                'user',
                'admin',
            ];

            foreach ($roles as $role) {
                Role::create(['name' => $role, 'guard_name' => 'api']);
            }
        });
    }
}
