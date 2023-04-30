<?php

namespace Database\Factories;

use App\Models\Semester;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Section>
 */
class SectionFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $setions = [
            'WMA 1A', 'WMA 1B', 'WMA 1C', 
            'WMA 4D', 'WMA 4E', 'WMA 4F', 
            'TSM 3C', 'TSM 3B', 'TSM 3A', 
            'TSM 1D', 'TSM 1E', 'TSM 1F', 
            'NA 3A', 'NA 3B', 'NA 3C', 
            'NA 1D', 'NA 1E', 'NA 1F', 
            'CS 1A', 'CS 1B', 'CS 1C', 
            'CS 2D', 'CS 2E', 'CS 2F', 
            'IS 1A', 'IS 1C', 'IS 1B', 
            'IS 2D', 'IS 2E', 'IS 2F', 
        ];

        return [
            'semester_id' => Semester::factory(),
            'section_name' => fake()->unique()->randomElement($setions),
        ];
    }
}
