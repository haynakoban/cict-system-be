<?php

namespace Database\Factories;

use App\Models\Room;
use App\Models\Section;
use App\Models\Semester;
use App\Models\Subject;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Attendance>
 */
class AttendanceFactory extends Factory
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
            'section_id' => Section::factory(),
            'subject_id' => Subject::factory(),
            'semester_id' => Semester::factory(),
            'attedance_group' => $this->faker->randomElement(['G1', 'G2', 'BOTH']),
            'attedance_status' => 'Not Visited',
            'attedance_day' => $this->faker->dayOfWeek(),
            'attedance_start_time' => $this->faker->time(),
            'attedance_end_time' => $this->faker->time(),
        ];
    }
}
