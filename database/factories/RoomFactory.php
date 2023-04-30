<?php

namespace Database\Factories;

use App\Models\Semester;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Room>
 */
class RoomFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $rooms = [
            'MacLab C01', 'MacLab C02', 'MacLab C03', 
            'AVR C01', 'AVR C02', 'AVR C03', 
            'IT L01', 'IT L02', 'IT L03', 
            'MIT R04', 'MIT R05', 'MIT L06', 
            'IS L01', 'IS L02', 'IS L03', 
            'CS R01', 'CS R02', 'CS R03', 
            'CpE M01', 'CpE M02', 'CpE M03', 
        ];
        
        return [
            'semester_id' => Semester::factory(),
            'room_name' => fake()->unique()->randomElement($rooms),
        ];
    }
}
