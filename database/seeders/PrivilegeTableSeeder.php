<?php

namespace Database\Seeders;

use App\Modules\Menu\Models\Menu;
use Illuminate\Database\Seeder;
use App\Modules\Privilege\Models\Privilege;
use App\Modules\Role\Models\Role;

class PrivilegeTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $menus = Menu::where('level', '<>', 0)->get();

        $role_superadmin = Role::where('role', 'Super Admin')->first();
        $role_admin = Role::where('role', 'Admin')->first();

        /*
        |--------------------------------------------------------------------------
        | MENU KHUSUS ADMIN
        |--------------------------------------------------------------------------
        */
        $adminOnlyMenus = [
            'User Kita',
            'Transaksi',
            'Kategori',
            'Barang',
            'Keranjang',
            'Detail Pemesanan',
        ];

        foreach ($menus as $menu) {

            /*
            |--------------------------------------------------------------------------
            | ADMIN
            |--------------------------------------------------------------------------
            | Admin mendapatkan akses penuh ke menu:
            | User, Barang, Transaksi, Kategori,
            | Detail Pemesanan, Keranjang
            |--------------------------------------------------------------------------
            */
            if (in_array($menu->menu, $adminOnlyMenus)) {

                Privilege::updateOrCreate(
                    [
                        'id_role' => $role_admin->id,
                        'id_menu' => $menu->id
                    ],
                    [
                        'show_menu' => 1,
                        'create' => 1,
                        'read' => 1,
                        'show' => 1,
                        'update' => 1,
                        'delete' => 1
                    ]
                );

                /*
                |--------------------------------------------------------------------------
                | SUPER ADMIN
                |--------------------------------------------------------------------------
                | Super Admin tidak mendapatkan akses ke menu Admin
                |--------------------------------------------------------------------------
                */
                Privilege::updateOrCreate(
                    [
                        'id_role' => $role_superadmin->id,
                        'id_menu' => $menu->id
                    ],
                    [
                        'show_menu' => 0,
                        'create' => 0,
                        'read' => 0,
                        'show' => 0,
                        'update' => 0,
                        'delete' => 0
                    ]
                );

            } else {

                /*
                |--------------------------------------------------------------------------
                | MENU LAIN
                |--------------------------------------------------------------------------
                | Super Admin tetap mendapatkan akses penuh.
                |--------------------------------------------------------------------------
                */
                Privilege::updateOrCreate(
                    [
                        'id_role' => $role_superadmin->id,
                        'id_menu' => $menu->id
                    ],
                    [
                        'show_menu' => 1,
                        'create' => 1,
                        'read' => 1,
                        'show' => 1,
                        'update' => 1,
                        'delete' => 1
                    ]
                );

                /*
                |--------------------------------------------------------------------------
                | ADMIN
                |--------------------------------------------------------------------------
                | Admin tidak mendapatkan menu khusus Super Admin.
                |--------------------------------------------------------------------------
                */
                Privilege::updateOrCreate(
                    [
                        'id_role' => $role_admin->id,
                        'id_menu' => $menu->id
                    ],
                    [
                        'show_menu' => 0,
                        'create' => 0,
                        'read' => 0,
                        'show' => 0,
                        'update' => 0,
                        'delete' => 0
                    ]
                );
            }
        }
    }
}