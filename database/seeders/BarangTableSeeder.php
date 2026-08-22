<?php

namespace Database\Seeders;

use App\Modules\Barang\Models\Barang;
use App\Modules\Kategori\Models\Kategori;
use Illuminate\Database\Seeder;

class BarangTableSeeder extends Seeder
{
    public function run(): void
    {
        $images = [
            '84sqk3VHTKPlPG2qPwZNITVGW5r0JPVkT9ikUtHD.png',
            'fBRaoUgVxIWpEEfJXlQy8Vn7OrMOkDkGbdxgK0MZ.jpg',
            'PtVwmrSh0bNx167nWWcEjmb7E6dBBFkmr1n913Ep.png',
            't0zQBqGBhmDz3exiQnDHiO65sBksbvdKxUs8fhej.png',
            'VF228YKERPXOmHO3YusX8UQroIt1nvZ0Cl7l07Rc.png',
        ];

        $menus = [
            'Makanan' => [
                ['Nasi Goreng', 20000], ['Ramen Spicy Beef', 25000], ['Beef Steak', 35000], ['Spaghetti Carbonara', 29000],
                ['Chicken Katsu Curry with Rice', 23000], ['Baso Aci', 15000], ['Creamy Garlic Shrimp with Rice', 27000], ['Nasi Padang', 21000],
                ['Salad Ayam Crispy', 20000], ['Chicken Wings', 24000], ['Salmon Sushi', 36000], ['Bakso', 19000],
                ['Ayam Geprek', 17000], ['Sate Padang', 21000], ['Soto Betawi', 28000], ['Bubur Ayam', 18000],
            ],
            'Snack' => [
                ['Cheese Tteokbokki', 18000], ['Wonton Chili Oil', 11000], ['Cimol Bajot', 10000], ['Udang Keju', 10000],
                ['Shilin Chicken Crispy', 23000], ['Cheesy Mushroom Pizza', 32000], ['Dimsum Mentai', 24000], ['French Fries', 13000],
                ['Churros', 11000], ['Dubai Chewy Cookie', 23000], ['Risol Coklat', 10000], ['Salt Bread', 15000],
                ['Mochi Daifuku', 9000], ['Strawberry Cheesecake', 17000], ['Cromboloni', 16000], ['Caramel Panna Cotta', 16000],
            ],
            'Minuman' => [
                ['Matcha Latte', 15000], ['Lemon Squash', 12000], ['Iced Americano', 10000], ['Coffee Milk', 25000],
                ['Thai Tea', 15000], ['Brown Sugar Boba Milk Tea', 18000], ['Lemon Tea', 10000], ['Noctil Galaxy Lemonade', 15000],
                ['Biscoff Latte', 17000], ['Strawberry Matcha Latte', 18000], ['Blueberry Frappe', 23000], ['Mango Yakult Milk', 19000],
                ['Ocean Milk Coffee Latte', 13000], ['Strawberry Mojito', 15000], ['Mixed Berry Smoothie', 20000], ['Lychee Tea', 12000],
            ],
        ];

        foreach ($menus as $namaKategori => $items) {
            $kategori = Kategori::where('nama_kategori', $namaKategori)->firstOrFail();

            foreach ($items as $index => [$nama, $harga]) {
                Barang::updateOrCreate(
                    [
                        'nama' => $nama,
                        'kategori_id' => $kategori->id,
                    ],
                    [
                        'stok' => 30,
                        'harga' => $harga,
                        'gambar' => $images[$index % count($images)],
                    ]
                );
            }
        }
    }
}
