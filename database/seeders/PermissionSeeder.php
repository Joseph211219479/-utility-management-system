<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Permission::create(['name' => 'view meter readings']);
        Permission::create(['name' => 'add meter']);
        Permission::create(['name' => 'add meter readings']);
        Permission::create(['name' => 'view meter totals']);
        Permission::create(['name' => 'add meter units']);
    }
}
