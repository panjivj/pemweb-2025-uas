<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SubjectSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $timestamp = Carbon::now()->toDateString();
        $subject = array(
            array('name' => 'Kabupaten Pandeglang', 'created_at' => $timestamp, 'updated_at' => $timestamp),
            array('name' => 'Kabupaten Lebak', 'created_at' => $timestamp, 'updated_at' => $timestamp),
            array('name' => 'Kabupaten Tangerang', 'created_at' => $timestamp, 'updated_at' => $timestamp),
            array('name' => 'Kabupaten Serang', 'created_at' => $timestamp, 'updated_at' => $timestamp),
            array('name' => 'Kota Tangerang', 'created_at' => $timestamp, 'updated_at' => $timestamp),
            array('name' => 'Kota Cilegon', 'created_at' => $timestamp, 'updated_at' => $timestamp),
            array('name' => 'Kota Serang', 'created_at' => $timestamp, 'updated_at' => $timestamp),
            array('name' => 'Kota Tangerang Selatan', 'created_at' => $timestamp, 'updated_at' => $timestamp),

        );
        DB::table('subjects')->insert($subject);

    }
}
