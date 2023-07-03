<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Hotel;
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

        $user = User::factory()->create([
            'first_name' => 'abc',
            'last_name' => 'xyz',
            'name' => 'abc',
            'email' => 'test@example.com',
            'email_verified_at' => now(),
            'password' => Hash::make('Test@123'),
        ]);

        $this->command->info('User created');

        Hotel::factory(5)->create([
            'user_id' => $user->id,
            'name' => fake()->name(),
            'city' => fake()->city(),
            'address_line_1' => fake()->address(),
            'description' => 'loream ipsum',
            'post_code' => fake()->postcode(),
        ]);

        $this->command->info('Hotels created');

        
    }
}
