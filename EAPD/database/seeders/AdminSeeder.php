<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $role = Role::firstOrCreate(['name' => 'SystemManager'],['guard_name' => 'web']);
        $user = User::updateOrCreate(
            [
                'email' => 'yossef.zaki@gmail.com',
            ],
            [
                'name' => 'Admin',
                'password' => 123456,
                // 'nice_name' => 'System Manager'
            ]
        );

        $user->assignRole($role);
    }
}
