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
        Role::create(['name' => 'admin' , 'guard_name' => 'api']); //has full crud in admin dashboard
        Role::create(['name' => 'reader', 'guard_name' => 'api']); // update readings/date from source
        Role::create(['name' => 'client', 'guard_name' => 'api']); // the source/customer/frontendUser
    }
}
