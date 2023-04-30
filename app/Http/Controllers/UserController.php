<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;

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

    public function store(Request $request)
    {
        $formFields = $request->validate([ 
            'user_employee_id' => ['required'],
            'user_first_name' => ['required'],
            'user_middle_name' => ['required'],
            'user_last_name' => ['required'],
            'user_username' => ['required', 'min:4', 'max:20', Rule::unique('users', 'username')],
            'user_email' => ['required', 'email', Rule::unique('users', 'email')],
            'user_password' => 'required|min:6',
            'user_position' => ['required'],
            'user_course_program' => ['required'],
            'user_role_type' => ['required'],
        ]);

         // hash password
        $formFields['user_password'] = bcrypt($formFields['user_password']);

        // create new user
        User::create($formFields);

        return response()->json(['message'=> 'success']);
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
