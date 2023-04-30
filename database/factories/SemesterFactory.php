<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Semester>
 */
class SemesterFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $semesters = array(
            '2024-2025 1st Semester' => '2024-2025 1st Semester', '2024-2025 2nd Semester' => '2024-2025 2nd Semester',
            '2025-2026 1st Semester' => '2025-2026 1st Semester', '2025-2026 2nd Semester' => '2025-2026 2nd Semester',
            '2026-2027 1st Semester' => '2026-2027 1st Semester', '2026-2027 2nd Semester' => '2026-2027 2nd Semester',
        );

        return [
            'semester_name' => fake()->unique()->randomElement($semesters),
        ];
    }
}
