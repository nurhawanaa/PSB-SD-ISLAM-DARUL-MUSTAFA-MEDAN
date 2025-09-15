<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Admin;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        Admin::create([
            'name' => 'Nurhawana',
            'email' => 'nurhawananasution14@gmail.com',
            'password' => Hash::make('secretsuperadmin'),
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
}
