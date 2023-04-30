<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\User>
 */
class UserFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'user_employee_id' => $this->faker->uuid(),
            'user_role_type' => $this->faker->numberBetween(1, 3),
            'user_first_name' => $this->faker->firstName(),
            'user_middle_name' => $this->faker->lastName(),
            'user_last_name' => $this->faker->lastName(),
            'user_name' => $this->faker->userName(),
            'user_email' => $this->faker->safeEmail(),
            'user_password' => bcrypt('test123'),
            'user_position' => $this->faker->jobTitle(),
            'user_course_program' => $this->faker->randomElement(['BSIT', 'MIT', 'BSCS', 'BSIS']),
            'user_age' => $this->faker->numberBetween(20, 60),
            'user_address' => $this->faker->address(),
        ];
    }

    /**
     * Indicate that the model's email address should be unverified.
     */
    public function unverified(): static
    {
        return $this->state(fn (array $attributes) => [
            'email_verified_at' => null,
        ]);
    }
}
