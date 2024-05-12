<?php

namespace Database\Seeders;

use App\Models\User;
use App\Support\Enums\Roles;
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
        if (app()->environment('production')) {
            User::create([
                'name' => 'John Doe',
                'email' => 'johndoe@gmail.com',
                'email_verified_at' => now(),
                'password' => Hash::make('password'),
                'remember_token' => Str::random(10),
                'username' => 'admin',
                'role' => Roles::ADMIN,
            ]);

            User::create([
                'name' => 'Jane Doe',
                'email' => 'janedoe@gmail.com',
                'email_verified_at' => now(),
                'password' => Hash::make('password'),
                'remember_token' => Str::random(10),
                'username' => 'uploader',
                'role' => Roles::UPLOADER,
            ]);

            User::create([
                'name' => 'James Doe',
                'email' => 'jamesdoe@gmail.com',
                'email_verified_at' => now(),
                'password' => Hash::make('password'),
                'remember_token' => Str::random(10),
                'username' => 'validator',
                'role' => Roles::VALIDATOR,
            ]);
        } else {
            User::factory(1)->create([
                'username' => 'admin',
                'role' => Roles::ADMIN,
            ]);

            User::factory(1)->create([
                'username' => 'uploader',
                'role' => Roles::UPLOADER,
            ]);

            User::factory(1)->create([
                'username' => 'validator',
                'role' => Roles::VALIDATOR,
            ]);
        }
    }
}
