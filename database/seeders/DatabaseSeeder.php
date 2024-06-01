<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Seed an Karyawan user
        DB::table('users')->insert([
            'name' => 'Karyawan',
            'username' => 'karyawan',
            'email' => 'karyawan@gmail.com',
            'email_verified_at' => now(),
            'password' => Hash::make('Pass1234'), // Hashed password
            'role' => 'KARYAWAN',
            'phone' => '1234567890',
            'birthdate' => '1990-01-01',
        ]);

        // Seed an admin user
        DB::table('users')->insert([
            'name' => 'Admin',
            'username' => 'admin',
            'email' => 'admin@gmail.com',
            'email_verified_at' => now(),
            'password' => Hash::make('Pass1234'), // Hashed password
            'role' => 'ADMIN',
            'phone' => '1234567890',
            'birthdate' => '1990-01-01',
        ]);

        // Seed a regular user
        DB::table('users')->insert([
            'name' => 'Superadmin',
            'username' => 'superadmin',
            'email' => 'superadmin@gmail.com',
            'email_verified_at' => now(),
            'password' => Hash::make('Pass1234'), // Hashed password
            'role' => 'SUPERADMIN',
            'phone' => '9876543210',
            'birthdate' => '1995-05-05',
        ]);
    }
}
