<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
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

    public function login($id)
    {
        $user = User::where('user_employee_id', $id)->first();

        return $user;
    }

    public function authenticate(Request $request)
    {
        $formFields = $request->validate([
            'username' => 'required',
            'password' => 'required'
        ]);

        if (Auth::attempt($formFields)) {
            $request->session()->regenerate();
            $user = auth()->user();
            
            return $user;
        }

        return $user = null;
    }
}
