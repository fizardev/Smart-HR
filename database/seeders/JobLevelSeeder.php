<?php

namespace Database\Seeders;

use App\Models\JobLevel;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class JobLevelSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $organisasi = [
            ['name' => 'Direktur'],
            ['name' => 'Owner'],
            ['name' => 'Kepala'],
            ['name' => 'Supervisor'],
            ['name' => 'Koordinator'],
            ['name' => 'Staff'],
            ['name' => 'Non Staff'],
            ['name' => 'Dokter Full-Time'],
            ['name' => 'Dokter Part-Time']
        ];

        foreach ($organisasi as $data) {
            JobLevel::create($data);
        }
    }
}
