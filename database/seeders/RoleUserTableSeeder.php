<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RoleUserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
       DB::table('role_user')->insert([
            'role_id' => 1, // Replace with the actual role_id
            'user_id' => 1, // Replace with the actual user_id
        ]);
    }
}
