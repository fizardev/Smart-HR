<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);

        $this->call(RolePermissionSeeder::class);
        $this->call(BankSeeder::class);
        $this->call(OrganizationSeeder::class);
        $this->call(CompanySeeder::class);
        $this->call(JobLevelSeeder::class);
        $this->call(JobPositionSeeder::class);
        $this->call(EmployeeSeeder::class);
        $this->call(UserSeeder::class);
        $this->call(AttendanceCodeSeeder::class);
        $this->call(ShiftSeeder::class);
    }
}
