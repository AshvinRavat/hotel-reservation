<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

        User::factory()->create([
            'first_name' => 'abc',
            'last_name' => 'xyz',
            'name' => 'abc',
            'email' => 'test@example.com',
            'email_verified_at' => now(),
            'password' => Hash::make('Test@123'),
        ]);

        $this->command->info('User created');
    }
}
