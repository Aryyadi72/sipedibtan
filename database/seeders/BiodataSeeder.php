<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class BiodataSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('users')->insert([
            [
                'users_id' => 1,
                'nama' => 'Admin',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'users_id' => 2,
                'nama' => 'Petugas',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'users_id' => 3,
                'nama' => 'Masyarakat',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
