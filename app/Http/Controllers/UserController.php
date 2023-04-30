<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class UserController extends Controller
{
    public function index()
    {

        $faculties = DB::table('users')
                    ->where('users.user_role_type', 2)
                    ->get();

        $checkers = DB::table('users')
                    ->where('users.user_role_type', 3)
                    ->get();

       
        return response()->json([
            'faculties' => $faculties,
            'checkers' => $checkers,
        ]);
    }
}
