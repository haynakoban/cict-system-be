<?php

namespace Database\Factories;

use App\Models\Room;
use App\Models\Semester;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\KeyHistory>
 */
class KeyHistoryFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'user_id' => User::factory(),
            'room_id' => Room::factory(),
            'semester_id' => Semester::factory(),
            'key_time' => $this->faker->time(),
            'key_status' => $this->faker->randomElement(['Borrowed', 'Returned']),
        ];
    }
}
