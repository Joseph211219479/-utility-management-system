<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class RolePermissionAssignerSeeder extends Seeder
{
    public function run()
    {
        // Get roles
        $adminRole = Role::where('name', 'admin')->first();
        $readerRole = Role::where('name', 'reader')->first();
        $clientRole = Role::where('name', 'client')->first();

        // Assign permissions to roles
        $adminRole->givePermissionTo(['view meters', 'create meter', 'view meter readings', 'create meter reading', 'view meter totals']);
        $readerRole->givePermissionTo(['create meter reading', 'view meters']);
        $clientRole->givePermissionTo(['view meter readings', 'view meter totals']);
    }
}
