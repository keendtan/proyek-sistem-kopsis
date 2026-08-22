<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Modules\Menu\Models\Menu;

class MenuTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $main = Menu::updateOrCreate(
            ['menu' => 'Main Menu', 'level' => 0],
            ['module' => 'no', 'routing' => 'no', 'is_tampil' => 1, 'icon' => 'fa-folder', 'urutan' => 1, 'parent_id' => '-', 'level' => 0]
        );

        $man = Menu::updateOrCreate(
            ['menu' => 'Management Menu', 'level' => 0],
            ['module' => 'no', 'routing' => 'no', 'is_tampil' => 1, 'icon' => 'fa-folder', 'urutan' => 2, 'parent_id' => '-', 'level' => 0]
        );

        $dev = Menu::updateOrCreate(
            ['menu' => 'Advance Menu', 'level' => 0],
            ['module' => 'no', 'routing' => 'no', 'is_tampil' => 1, 'icon' => 'fa-folder', 'urutan' => 3, 'parent_id' => '-', 'level' => 0]
        );

        Menu::updateOrCreate(
            ['module' => 'dashboard'],
            ['menu' => 'Dashboard', 'routing' => 'dashboard', 'is_tampil' => 1, 'icon' => 'fa-tachometer-alt', 'urutan' => 1, 'parent_id' => $main->id, 'level' => 1]
        );
        Menu::updateOrCreate(
            ['module' => 'config'],
            ['menu' => 'Konfigurasi', 'routing' => 'config.index', 'is_tampil' => 1, 'icon' => 'fa-cogs', 'urutan' => 2, 'parent_id' => $man->id, 'level' => 1]
        );
        Menu::updateOrCreate(
            ['module' => 'users'],
            ['menu' => 'User', 'routing' => 'users.index', 'is_tampil' => 1, 'icon' => 'fa-user', 'urutan' => 3, 'parent_id' => $man->id, 'level' => 1]
        );

        // dev
        Menu::updateOrCreate(
            ['module' => 'role'],
            ['menu' => 'Role', 'routing' => 'role.index', 'is_tampil' => 1, 'icon' => 'fa-user-tag', 'urutan' => 1, 'parent_id' => $dev->id, 'level' => 1]
        );
        Menu::updateOrCreate(
            ['module' => 'menu'],
            ['menu' => 'Menu', 'routing' => 'menu.index', 'is_tampil' => 1, 'icon' => 'fa-list', 'urutan' => 2, 'parent_id' => $dev->id, 'level' => 1]
        );
        Menu::updateOrCreate(
            ['module' => 'privilege'],
            ['menu' => 'Privilege', 'routing' => 'privilege.index', 'is_tampil' => 0, 'icon' => 'fa-user-cog', 'urutan' => 3, 'parent_id' => $dev->id, 'level' => 1]
        );
        Menu::updateOrCreate(
            ['module' => 'files'],
            ['menu' => 'Storage', 'routing' => 'files.index', 'is_tampil' => 1, 'icon' => 'fa-box-open', 'urutan' => 4, 'parent_id' => $dev->id, 'level' => 1]
        );
        Menu::updateOrCreate(
            ['module' => 'jenisfile'],
            ['menu' => 'Jenis File', 'routing' => 'jenisfile.index', 'is_tampil' => 0, 'icon' => 'fa-boxes', 'urutan' => 5, 'parent_id' => $dev->id, 'level' => 1]
        );
        Menu::updateOrCreate(
            ['module' => 'log'],
            ['menu' => 'Log', 'routing' => 'log.index', 'is_tampil' => 1, 'icon' => 'fa-wave-square', 'urutan' => 6, 'parent_id' => $dev->id, 'level' => 1]
        );
    }
}
