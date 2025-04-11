<?php

namespace Database\Factories;

use App\Models\School;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class CourseFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'school_id' => School::factory(),
            'name' => $this->faker->name(),
            'description' => $this->faker->sentence(),
            'amount' => $this->faker->randomFloat(2, 100, 1000),
            'duration' => $this->faker->time('H:i'),
        ];
    }
}
