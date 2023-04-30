<?php

namespace App\Http\Controllers;

use App\Models\Section;
use App\Models\Semester;
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

        $semesters = Semester::all();

        return response()->json(['sections' => $sections, 'semesters' => $semesters]);
    }

    public function store(Request $request)
    {
        $section = Section::create([
            'semester_id' => $request->semester_id,
            'section_name' => $request->section_name,
        ]);

        return response()->json(['message' => 'new section created', 'section' => $section]); 
    }

    public function update(Request $request)
    {
        $section = Section::where('id', $request->section_id)->first();
        $section->section_name = $request->section_name;
        $section->save();

        return response()->json(['message' => 'section updated', 'section' => $section]); 
    }

    public function delete(Request $request)
    {
        Section::where('id', $request->section_id)->delete();

        return response()->json(['message' => 'section deleted']); 
    }
}
