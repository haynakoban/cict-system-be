<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SectionController extends Controller
{
    public function index()
    {
       $sections = DB::table('sections')
                ->join('semesters', 'semesters.id', '=', 'sections.semester_id')
                ->select('sections.id as section_id', 'sections.*', 'semesters.*')
                ->get();

        return response()->json(['sections' => $sections]);
    }

    public function store(Request $request)
    {
        
    }
}
