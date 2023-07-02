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
        $superAdmin = User::create([
            'name' => 'Administrator',
            'email' => 'admin@example.com',
            'password' => bcrypt('admin'),
        ]);

        $superAdmin->assignRole('super-admin');

        $user = User::create([
            'name' => 'User',
            'email' => 'user@example.com',
            'password' => bcrypt('user'),
        ]);

        $user->assignRole('student');

        $user = User::create([
            'name' => 'Dosen',
            'email' => 'dosen@example.com',
            'password' => bcrypt('dosen'),
        ]);

        $user->assignRole('lecturer');
    }
}
