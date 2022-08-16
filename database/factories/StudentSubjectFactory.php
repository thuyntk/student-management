<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\StudentSubject>
 */
class StudentSubjectFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */

    public function definition()
    {
        return [
            'student_id' => rand(1, 10),
            'subject_id' => rand(1, 10),
            'point' => rand(0, 10),
        ];
    }
}
