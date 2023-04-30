<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Attendance;
use App\Models\KeyHistory;
use App\Models\Room;
use App\Models\Section;
use App\Models\Semester;
use App\Models\Subject;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        User::factory()->count(5)->create(['role_type' => 1]); // seed admin user
        User::factory()->count(30)->create(['role_type' => 2]); // seed faculty user
        User::factory()->count(10)->create(['role_type' => 3]); // seed checker user

        Semester::factory()->count(4)->create(); // seed semester

        // seed subjects
        for ($i=0; $i < 15; $i++) { 
            $semester = Semester::inRandomOrder()->first();
            Room::factory()->count(1)->create(['semester_id' => $semester->id]); // seed rooms
            Subject::factory()->count(1)->create(['semester_id' => $semester->id]); // seed subjects
            Section::factory()->count(1)->create(['semester_id' => $semester->id]); // seed sections
        }

        // get all faculties
        $faculties = User::where('role_type', 2)->inRandomOrder()->get();  

        foreach ($faculties as $faculty) {

            $room = Room::inRandomOrder()->first();
            $section = Section::inRandomOrder()->first();
            $subject = Subject::inRandomOrder()->first();
            $semester = Semester::inRandomOrder()->first();

            // seed key history
            KeyHistory::factory()
                ->create([
                    'room_id' => $room->id,
                    'user_id' => $faculty->id, 
                    'semester_id' => $semester->id
                ]);

            // seed attendance
            Attendance::factory()
                ->create([
                    'user_id' => $faculty->id, 
                    'room_id' => $room->id,
                    'section_id' => $section->id,
                    'subject_id' => $subject->id,
                    'semester_id' => $semester->id,
                ]);
        }
    }
}
