<?php

namespace Database\Seeders;

use App\Models\Menu;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class MenuSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Menu::create([
            'name' => 'Users',
            'url' => 'security/users',
            'icon' => '',
            'main_menu' => null,
            'sort' => 1
        ]);

        Menu::create([
            'name' => 'Roles',
            'url' => 'security/roles',
            'icon' => '',
            'main_menu' => null,
            'sort' => 2
        ]);
    }
}
