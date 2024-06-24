<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Role::create(['name' => 'admin']); //has full crud in admin dashboard
        Role::create(['name' => 'reader']); // update readings/date from source
        Role::create(['name' => 'client']); // the source/customer/frontendUser
    }
}
