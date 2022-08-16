<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Student>
 */
class StudentFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'name'=> fake()->name(),
            'email' => fake()->unique()->email,
            'phone' => fake()->phoneNumber(),
            'avatar' => $this->faker->imageUrl(100, 100),
            'address' => $this->faker->text(),
            'birthday' => $this->faker->date($format = 'Y-m-d'),
            'gender' => rand(0,1),
            'faculty_id' => rand(1,10),
        ];
    }
}
