<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class BikeSeeder extends Seeder
{
    /**
     * Isi data dummy sepeda.
     * Nama file gambar ada di kolom 'image' dan harus ada di public/assets/images/
     * (kalau file belum ada, halaman otomatis memakai gambar placeholder).
     */
    public function run(): void
    {
        DB::table('bikes')->truncate();

        DB::table('bikes')->insert([
            ['brand' => 'Polygon',  'type' => 'Mountain Bike',  'rent_price' => 75000,  'gear_count' => 27, 'image' => 'sepeda-1.jpg', 'available' => true],
            ['brand' => 'United',   'type' => 'Road Bike',      'rent_price' => 90000,  'gear_count' => 18, 'image' => 'sepeda-2.webp', 'available' => true],
            ['brand' => 'Pacific',  'type' => 'Fixie',          'rent_price' => 50000,  'gear_count' => 1,  'image' => 'sepeda-3.jpg', 'available' => true],
            ['brand' => 'Element',  'type' => 'Sepeda Lipat',   'rent_price' => 65000,  'gear_count' => 7,  'image' => 'sepeda-4.jpg', 'available' => false],
            ['brand' => 'Thrill',   'type' => 'Mountain Bike',  'rent_price' => 70000,  'gear_count' => 21, 'image' => 'sepeda-5.jpg', 'available' => true],
            ['brand' => 'Selis',    'type' => 'Sepeda Listrik', 'rent_price' => 120000, 'gear_count' => 5,  'image' => 'sepeda-6.jpg', 'available' => true],
            ['brand' => 'Wimcycle', 'type' => 'City Bike',      'rent_price' => 55000,  'gear_count' => 6,  'image' => 'sepeda-7.jpg', 'available' => true],
            ['brand' => 'Giant',    'type' => 'Road Bike',      'rent_price' => 150000, 'gear_count' => 22, 'image' => 'sepeda-8.jpg', 'available' => false],
        ]);
    }
}
