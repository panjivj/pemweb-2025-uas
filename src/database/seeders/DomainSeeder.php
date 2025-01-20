<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DomainSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        $timestamp = Carbon::now()->toDateString();
        $domain = [
            ['name' => 'Domain Kebijakan', 'created_at' => $timestamp, 'updated_at' => $timestamp],
            ['name' => 'Domain Tata Kelola', 'created_at' => $timestamp, 'updated_at' => $timestamp],
            ['name' => 'Domain Manajemen', 'created_at' => $timestamp, 'updated_at' => $timestamp],
            ['name' => 'Domain Layanan', 'created_at' => $timestamp, 'updated_at' => $timestamp],
        ];

        DB::table('domains')->insert($domain);

    }
}
