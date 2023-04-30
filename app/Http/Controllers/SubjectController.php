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

    public function update(Request $request)
    {
        $subject = Subject::where('id', $request->subject_id)->first();
        $subject->subject_name = $request->subject_name;
        $subject->save();

        return response()->json(['message' => 'subject updated', 'subject' => $subject]); 
    }

    public function delete(Request $request)
    {
        Subject::where('id', $request->subject_id)->delete();

        return response()->json(['message' => 'subject deleted']); 
    }
}
