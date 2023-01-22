<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $administrator = Role::create(['name' => 'Administrator']);
        $administrator->givePermissionTo(Permission::all());

        $operator = Role::create(['name' => 'Operator']);
        $operator->syncPermissions([
            'View Dashboard',
            'View User Menu',
        ]);
    }
}
