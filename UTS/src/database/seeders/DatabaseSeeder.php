<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        User::factory()->create([
            'name' => 'panjijayasutra',
            'email' => 'admin@admin.com',
            'password' => Hash::make('p455w0rd'),
        ]);

        User::factory()->create([
            'name' => 'Customer',
            'email' => 'customer@customer.com',
            'password' => Hash::make('customer1'),
        ]);

        User::factory()->create([
            'name' => 'Waiter',
            'email' => 'waiter@waiter.com',
            'password' => Hash::make('waiter1'),
        ]);

        
        $this->call([
            KategoriSeeder::class,  
            MenuSeeder::class, 
            DetailUserSeeder::class,     
        ]);
    }
}
