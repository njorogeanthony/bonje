<?php

namespace Database\Seeders;

use App\Models\User;
use App\Support\Enums\Roles;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
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
