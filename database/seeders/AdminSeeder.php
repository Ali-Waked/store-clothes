<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            'name' => 'ali waked',
            'email' => 'ali.waked@gmail.com',
            'is_admin' => true,
            'password' => Hash::make('password'),
            'email_verified_at' => now(),
        ]);
    }
}
