<?php

namespace App\Http\Controllers;

use App\Models\Semester;
use App\Models\Subject;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SubjectController extends Controller
{
    public function index()
    {
       $subjects = DB::table('subjects')
                ->join('semesters', 'semesters.id', '=', 'subjects.semester_id')
                ->select('subjects.id as subject_id', 'subjects.*', 'semesters.*')
                ->get();

        $semesters = Semester::all();

        return response()->json(['subjects' => $subjects, 'semesters' => $semesters]);
    }

    public function store(Request $request)
    {
        $subject = Subject::create([
            'semester_id' => $request->semester_id,
            'subject_name' => $request->subject_name,
        ]);

        return response()->json(['message' => 'new subject created', 'subject' => $subject]); 
    }
}
