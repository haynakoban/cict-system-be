<?php

namespace Database\Factories;

use App\Models\Semester;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Subject>
 */
class SubjectFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $subjects = [
            'Computer Programming 1', 'Computer Programming 2', 'Computer Programming 3', 
            'Cisco 1', 'Cisco 2', 'Cisco 3', 
            'Web Design 1', 'Web Design 2', 'Web Design 3', 
            'Operation System 1', 'Operation System 2', 'Operation System 3', 
            'Web Development 1', 'Web Development 2', 'Web Development 3', 
            'Mobile Application 1', 'Mobile Application 2', 'Mobile Application 3', 
            'Software Development 1', 'Software Development 2', 'Software Development 3', 
            'Integrative Programming 1', 'Integrative Programming 2', 'Integrative Programming 3', 
        ];

        return [
            'semester_id' => Semester::factory(),
            'subject_name' => fake()->unique()->randomElement($subjects),
        ];
    }
}
