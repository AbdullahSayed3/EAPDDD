<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([AdminSeeder::class,RolePermissionSeeder::class,PermissionSeeder::class,CountrySeeder::class]);
    }
}
