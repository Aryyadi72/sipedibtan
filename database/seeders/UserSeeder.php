<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('users')->insert([
            [
                'email' => 'admin@example.com',
                'password' => Hash::make('password123'),
                'level' => 'Admin',
                'inputed_by' => 'System',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'email' => 'petugas@example.com',
                'password' => Hash::make('password123'),
                'level' => 'Petugas',
                'inputed_by' => 'System',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'email' => 'masyarakat@example.com',
                'password' => Hash::make('password123'),
                'level' => 'Masyarakat',
                'inputed_by' => 'System',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
