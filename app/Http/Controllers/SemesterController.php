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
}
