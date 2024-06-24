<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $permissions = [
            'view meter readings',
            'create meter reading',
            'update meter reading',
            'delete meter reading',
            'view meters',
            'create meter',
            'update meters',
            'delete meters',
            'request more units',
            'view meter totals',
        ];

        foreach ($permissions as $permission) {
            if (!Permission::where('name', $permission)->exists()) {
                Permission::create(['name' => $permission,  'guard_name' => 'api' ]);
            }
        }
    }
}
