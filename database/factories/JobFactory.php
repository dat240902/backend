<?php

namespace Database\Factories;

use App\Models\Company;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Job>
 */
class JobFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'title' => fake()->jobTitle(),
            'description' => fake()->text(),
            'benefits' => fake()->text(),
            'address' => fake()->address(),
            'company_id' => function() {
                Company::factory()->create()->id;
            }
        ];
    }
}
