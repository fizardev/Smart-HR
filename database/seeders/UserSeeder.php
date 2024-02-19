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
        $users = [
            [
                'name' => "Dimas Candra Pebriyanto",
                'email' => "dimas@livasya.id",
            ], [
                'name' => "Tiyas Frahesta",
                'email' => "tiyas@livasya.id",
            ]
        ];

        foreach ($users as $user) {
            User::create($user);
        }
    }
}
