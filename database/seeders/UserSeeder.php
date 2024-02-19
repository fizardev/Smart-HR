<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $admin = User::create([
            'name' => 'Admin',
            'email' => 'admin@livasya.com',
        ]);

        $admin->assignRole('admin');

        $hr = User::create([
            'name' => 'HR Livasya',
            'email' => 'hr@livasya.com',
        ]);

        $hr->assignRole('hr');

        $manager = User::create([
            'name' => 'Manager Livasya',
            'email' => 'manager@livasya.com',
        ]);

        $manager->assignRole('manager');

        $fizar = User::create([
            'name' => 'Fizar Rama Waluyo, S. Kom.',
            'email' => 'fizar@livasya.id',
        ]);

        $fizar->assignRole('employee');

        $dimas = User::create([
            'name' => 'Dimas Chandra',
            'email' => 'dimas@livasya.id',
        ]);

        $dimas->assignRole('employee');
    }
}
