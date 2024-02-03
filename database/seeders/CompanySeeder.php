<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CompanySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('company')->insert([
            'name' => 'Rumah Sakit Livasya',
            'phone_number' => '(0233) 8668019',
            'email' => 'fizardev@gmail.com',
            'address' => 'Jl. Raya Timur III No.875, Dawuan, Kec. Dawuan, Kabupaten Majalengka, Jawa Barat 45453',
            'province' => 'Jawa Barat',
            'city' => 'Majalengka',
            'logo' => 'logo.png',
            'category' => 'Kesehatan',
            'class' => 'Kelas C',
            'operating_permit_number' => '29032200430920001',
        ]);
    }
}
