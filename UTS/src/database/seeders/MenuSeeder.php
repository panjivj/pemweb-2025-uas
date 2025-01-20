<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Menu;
use App\Models\Kategori;

class MenuSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Menambahkan 5 makanan
        Menu::create([
            'kategori_id' => 1,
            'name' => 'Nasi Padang',
            'description' => 'Nasi dengan lauk khas Padang',
            'price' => 20000.00,
            'is_available' => true,
        ]);

        Menu::create([
            'kategori_id' => 1,
            'name' => 'Mie Goreng',
            'description' => 'Mie goreng dengan bumbu spesial',
            'price' => 15000.00,
            'is_available' => true,
        ]);

        Menu::create([
            'kategori_id' => 1,
            'name' => 'Ayam Penyet',
            'description' => 'Ayam goreng dengan sambal khas',
            'price' => 25000.00,
            'is_available' => true,
        ]);

        Menu::create([
            'kategori_id' => 1,
            'name' => 'Sate Ayam',
            'description' => 'Sate ayam dengan bumbu kacang',
            'price' => 18000.00,
            'is_available' => true,
        ]);

        Menu::create([
            'kategori_id' => 1,
            'name' => 'Gado-Gado',
            'description' => 'Salad dengan saus kacang',
            'price' => 22000.00,
            'is_available' => false,
        ]);

        // Menambahkan 5 minuman
        Menu::create([
            'kategori_id' => 2,
            'name' => 'Es Teh Manis',
            'description' => 'Teh manis dengan es batu',
            'price' => 5000.00,
            'is_available' => true,
        ]);

        Menu::create([
            'kategori_id' => 2,
            'name' => 'Jus Jeruk',
            'description' => 'Jus jeruk segar',
            'price' => 15000.00,
            'is_available' => true,
        ]);

        Menu::create([
            'kategori_id' => 2,
            'name' => 'Kopi Hitam',
            'description' => 'Kopi hitam tanpa gula',
            'price' => 10000.00,
            'is_available' => true,
        ]);

        Menu::create([
            'kategori_id' => 2,
            'name' => 'Es Kelapa Muda',
            'description' => 'Kelapa muda dengan es',
            'price' => 12000.00,
            'is_available' => true,
        ]);

        Menu::create([
            'kategori_id' => 2,
            'name' => 'Soda Gembira',
            'description' => 'Minuman soda dengan susu kental manis',
            'price' => 15000.00,
            'is_available' => false,
        ]);

        // Menambahkan 5 cemilan
        Menu::create([
            'kategori_id' => 3,
            'name' => 'Pisang Goreng',
            'description' => 'Pisang goreng dengan taburan gula',
            'price' => 8000.00,
            'is_available' => true,
        ]);

        Menu::create([
            'kategori_id' => 3,
            'name' => 'Keripik Singkong',
            'description' => 'Keripik singkong gurih',
            'price' => 10000.00,
            'is_available' => true,
        ]);

        Menu::create([
            'kategori_id' => 3,
            'name' => 'Martabak Manis',
            'description' => 'Martabak manis dengan berbagai topping',
            'price' => 25000.00,
            'is_available' => false,
        ]);

        Menu::create([
            'kategori_id' => 3,
            'name' => 'Kue Cubir',
            'description' => 'Kue cubir isi cokelat',
            'price' => 7000.00,
            'is_available' => true,
        ]);

        Menu::create([
            'kategori_id' => 3,
            'name' => 'Roti Bakar',
            'description' => 'Roti bakar dengan selai coklat',
            'price' => 15000.00,
            'is_available' => true,
        ]);
    }
}

