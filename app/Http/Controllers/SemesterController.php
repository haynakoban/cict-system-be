<?php

namespace App\Http\Controllers;

use App\Models\Semester;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SemesterController extends Controller
{
    public function index()
    {
       $semesters = DB::table('semesters')->get();

        return response()->json(['semesters' => $semesters]);
    }

    public function store(Request $request)
    {
        $semester = Semester::create([
            'semester_name' => $request->semester_name,
        ]);

        return response()->json(['message' => 'new semester created', 'semester' => $semester]); 
    }

    public function update(Request $request)
    {
        $semester = Semester::where('id', $request->semester_id)->first();
        $semester->semester_name = $request->semester_name;
        $semester->save();

        return response()->json(['message' => 'semester updated', 'semester' => $semester]); 
    }

    public function delete(Request $request)
    {
        Semester::where('id', $request->semester_id)->delete();

        return response()->json(['message' => 'semester deleted']); 
    }
}
