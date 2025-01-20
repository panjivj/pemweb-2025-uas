<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DetailUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('detail_users')->insert([
            [
                'username' => 'Andi',
                'bank' => 'Mandiri',
                'norek' => '1230001234567', // 13 digit
            ],
            [
                'username' => 'Budi',
                'bank' => 'BCA',
                'norek' => '1234567890', // 10 digit
            ],
            [
                'username' => 'Citra',
                'bank' => 'BRI',
                'norek' => '123456789012345', // 15 digit
            ],
            [
                'username' => 'Dewi',
                'bank' => 'BNI',
                'norek' => '1234567890', // 10 digit
            ],
            [
                'username' => 'Eko',
                'bank' => 'Danamon',
                'norek' => '123456789012', // 12 digit
            ],
            [
                'username' => 'Fajar',
                'bank' => 'CIMB Niaga',
                'norek' => '1234567890123', // 13 digit
            ],
        ]);
    }
}
