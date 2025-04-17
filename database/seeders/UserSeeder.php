<?php

namespace Database\Seeders;

use App\Models\User;
use Hash;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Str;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::insert([
            'name' => 'Esra Nur Şeker',
            'email' => 'esranurseker@gmail.com',
            'email_verified_at' => now(),
            'type' => 'admin',
            'password' => Hash::make('password'),
            'remember_token'=> Str::random(10),
        ]);
         User::factory(10)->create();
    }
}
