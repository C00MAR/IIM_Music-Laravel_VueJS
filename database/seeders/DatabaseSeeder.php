<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Track;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        User::factory(10)->create();

        User::factory()->create([
            'name' => 'User Test',
            'email' => 'test@mail.com',
        ]);

        User::factory()->create([
            'name' => 'Admin Test',
            'email' => 'test@exemple.com',
            'admin' => true
        ]);

        Track::factory(50)->create();
    }
}
