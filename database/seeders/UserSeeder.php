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
            'username' => 'admin',
            'email' => 'admin@livasya.com',
            'password' => bcrypt('adminlivasya'),
        ]);

        $admin->assignRole('admin');

        $hr = User::create([
            'name' => 'HR Livasya',
            'username' => 'hrlivasya',
            'email' => 'hr@livasya.com',
            'password' => bcrypt('hrlivasya'),
        ]);

        $hr->assignRole('hr');

        $manager = User::create([
            'name' => 'Manager Livasya',
            'username' => 'managerlivasya',
            'email' => 'manager@livasya.com',
            'password' => bcrypt('managerlivasya'),
        ]);

        $manager->assignRole('manager');

        $fizar = User::create([
            'name' => 'Fizar Rama Waluyo, S. Kom.',
            'username' => 'fizar',
            'email' => 'fizar@livasya.com',
            'password' => bcrypt('employeelivasya'),
        ]);

        $fizar->assignRole('employee');

        $dimas = User::create([
            'name' => 'Dimas Chandra',
            'username' => 'dimas',
            'email' => 'dimas@livasya.com',
            'password' => bcrypt('employeelivasya'),
        ]);

        $dimas->assignRole('employee');
    }
}
