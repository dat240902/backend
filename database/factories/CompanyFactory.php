<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Company>
 */
class CompanyFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'name' => fake()->company(),
            'email' => fake()->unique()->safeEmail(),
            'address' => fake()->address(),
            'description' => fake()->text(),
            'email_verified_at' => now(),
            'password' => Hash::make('password') // secret
        ];
    }
}
