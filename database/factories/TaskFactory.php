<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Task>
 */
class TaskFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            //qekjo sentence pa () eshte property e i perdor default functions
            //kurse functions si paragraph(8,true) per me ba customized
            'title' =>fake()->sentence,
            'description' => fake()->paragraph,
            'long_description' => fake()->paragraph(7,true),
            'completed' =>fake()->boolean
        ];
    }
}
