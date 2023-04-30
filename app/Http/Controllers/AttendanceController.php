<?php

namespace App\Http\Controllers;

use App\Models\Attendance;
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
                ->where('users.role_type', 2) // select faculty only
                ->get();

        $attendances = DB::table('attendances')
            ->join('rooms', 'rooms.id', '=', 'attendances.room_id')
            ->join('users', 'users.id',  '=', 'attendances.user_id')
            ->join('semesters', 'semesters.id',  '=', 'attendances.semester_id')
            ->join('subjects', 'subjects.id',  '=', 'attendances.subject_id')
            ->join('sections', 'sections.id',  '=', 'attendances.section_id')
            ->select('attendances.id as attendance_id', 'attendances.*', 'rooms.*', 'users.*', 'semesters.*', 'subjects.*', 'sections.*')
            ->where('users.role_type', 2) // select faculty only
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

    public function store(Request $request)
    {
        $formFields = $request->validate([
            'user_id' => ['required'],
            'room_id' => ['required'],
            'section_id' => ['required'],
            'subject_id' => ['required'],
            'semester_id' => ['required'],
            'attendance_group' => ['required'],
            'attendance_day' => ['required'],
            'attendance_start_time' => ['required'],
            'attendance_end_time' => ['required'],
        ]);

        $attendance = Attendance::create($formFields);  

        return response()->json(['message' => 'success', 'attendance' => $attendance]);
    }

    public function update(Request $request)
    {
        $attendance = Attendance::where('id', $request->id)->first();
        
        if($request->comments){
            $attendance->attendance_comments = $request->comments;
        }

        if($request->attendance_status){
            $attendance->attendance_status = $request->attendance_status;
        }

        $attendance->save();

        return response()->json(['message'=> 'attendance created']);
    }

    public function show($id)
    {
         $semesters = Semester::all();
        $rooms = Room::all();
        $subjects = Subject::all();
        $sections = Section::all();

        $users = DB::table('users')
                ->where('users.role_type', 2) // select faculty only
                ->get();

        $attendances = DB::table('attendances')
            ->join('rooms', 'rooms.id', '=', 'attendances.room_id')
            ->join('users', 'users.id',  '=', 'attendances.user_id')
            ->join('semesters', 'semesters.id',  '=', 'attendances.semester_id')
            ->join('subjects', 'subjects.id',  '=', 'attendances.subject_id')
            ->join('sections', 'sections.id',  '=', 'attendances.section_id')
            ->select('attendances.id as attendance_id', 'attendances.*', 'rooms.*', 'users.*', 'semesters.*', 'subjects.*', 'sections.*')
            ->where('users.role_type', 2) // select faculty only
            ->where('attendances.user_id', $id) // select faculty only
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
