<?php

namespace App\Http\Controllers;

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

        return response()->json(['subjects' => $subjects]);
    }

    public function store(Request $request)
    {
        
    }
}
