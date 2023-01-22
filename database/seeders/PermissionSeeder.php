<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        Permission::create(['name' => 'View Dashboard']);

        //User
        Permission::create(['name' => 'View User Menu']);
        Permission::create(['name' => 'Create New User']);
        Permission::create(['name' => 'Edit User Info']);
        Permission::create(['name' => 'Delete User']);

        //Role
        Permission::create(['name' => 'View Role Menu']);
        Permission::create(['name' => 'Create Role User']);
        Permission::create(['name' => 'Edit Role Info']);
        Permission::create(['name' => 'Delete Role']);

        //Permission
        Permission::create(['name' => 'View Permission Menu']);
        Permission::create(['name' => 'Edit Role Permission']);
    }
}
