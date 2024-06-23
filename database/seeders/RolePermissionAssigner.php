<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class RolePermissionAssigner extends Seeder
{
    public function run()
    {
        // Get roles
        $adminRole = Role::where('name', 'admin')->first();
        $readerRole = Role::where('name', 'reader')->first();
        $userRole = Role::where('name', 'user')->first();

        // Assign permissions to roles
        $adminRole->givePermissionTo(['view meters', 'add meter', 'view meter readings', 'add meter readings', 'view meter totals']);
        $readerRole->givePermissionTo(['add meter reading', 'view meters']);
        $userRole->givePermissionTo(['view meter readings', 'view meter totals']);
    }
}
