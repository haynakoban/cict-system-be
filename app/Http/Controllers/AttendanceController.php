<?php

namespace App\Http\Controllers;

use App\Models\Room;
use App\Models\Section;
use App\Models\Semester;
use App\Models\Subject;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AttendanceController extends Controller
{
    public function index()
    {
        $semesters = Semester::all();
        $rooms = Room::all();
        $subjects = Subject::all();
        $sections = Section::all();

        $users = DB::table('users')
                ->where('users.user_role_type', 2) // select faculty only
                ->get();

        $attendances = DB::table('attendances')
            ->join('rooms', 'rooms.id', '=', 'attendances.room_id')
            ->join('users', 'users.id',  '=', 'attendances.user_id')
            ->select('attendances.id as attendance_id', 'attendances.*', 'rooms.*', 'users.*')
            ->where('users.user_role_type', 2) // select faculty only
            ->orderBy('attendances.created_at', 'desc')
            ->get();

        return [
            'attendances' =>  $attendances,
            'semesters' => $semesters,
            'users' => $users,
            'rooms' => $rooms,
            'subjects' => $subjects,
            'sections' => $sections,
        ];
    }
}
