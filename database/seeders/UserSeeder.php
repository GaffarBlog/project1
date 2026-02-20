<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            'name' => "Abdul Gaffar",
            'email' => "admin@gmail.com",
            'username' => "admin@gmail.com",
            'phone' => "0123456789",
            'date_of_birth' => fake()->date(),
            'gender' => "Male",
            'country' => "Bangladesh",
            'city' => "Bogura",
            'zip' => "5830",
            'address' => "Bogura, Bangladesh",
            'status' => "Active",
            'role_id' => 1,
            'email_verified_at' => Carbon::now(),
            'password' => Hash::make('123456'),
            'remember_token' => Str::random(10),
        ]);
        User::factory()->count(50)->create();
    }
}
