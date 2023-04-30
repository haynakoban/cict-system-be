<?php

namespace App\Http\Controllers;

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
        
    }
}
