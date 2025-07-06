<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RolePermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $admin = Role::firstOrCreate(['name'=>'SystemManager','guard_name'=>'web']);

        
        Permission::firstOrCreate(['name'=>'manage_courses']);
        Permission::firstOrCreate(['name'=>'manage_applicants']);
        Permission::firstOrCreate(['name'=>'manage_experts']);
        Permission::firstOrCreate(['name'=>'manage_aids']);
        Permission::firstOrCreate(['name'=>'manage_teral_terials']);
        Permission::firstOrCreate(['name'=>'manage_events']);
        Permission::firstOrCreate(['name'=>'manage_settings']);
        Permission::firstOrCreate(['name'=>'manage_scholarships']);
        Permission::firstOrCreate(['name'=>'manage_learners']);

        $admin->givePermissionTo([
            'manage_courses',
            'manage_applicants',
            'manage_experts',
            'manage_aids',
            'manage_teral_terials',
            'manage_events',
            'manage_settings',
            'manage_scholarships',
            'manage_learners',
        ]);
    }
}
