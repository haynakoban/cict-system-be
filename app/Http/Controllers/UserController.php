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
                    ->where('users.role_type', 2)
                    ->get();

        $checkers = DB::table('users')
                    ->where('users.role_type', 3)
                    ->get();

       
        return response()->json([
            'faculties' => $faculties,
            'checkers' => $checkers,
        ]);
    }

    public function store(Request $request)
    {
        $formFields = $request->validate([ 
            'employee_id' => ['required'],
            'first_name' => ['required'],
            'middle_name' => ['required'],
            'last_name' => ['required'],
            'username' => ['required', 'min:4', 'max:20', Rule::unique('users', 'username')],
            'email' => ['required', 'email', Rule::unique('users', 'email')],
            'password' => 'required|min:6',
            'position' => ['required'],
            'course_program' => ['required'],
            'role_type' => ['required'],
        ]);

         // hash password
        $formFields['password'] = bcrypt($formFields['password']);

        // create new user
        User::create($formFields);

        return response()->json(['message'=> 'success']);
    }

    public function login($id)
    {
        $user = User::where('employee_id', $id)->first();

        return $user;
    }

    public function authenticate(Request $request)
    {
        $formFields = $request->validate([
            'username' => 'required',
            'password' => 'required'
        ]);

        if (auth()->attempt($formFields)) {
            $request->session()->regenerate();
            $user = User::where('id', auth()->user()->id)->first();
            $user->status = 'online';
            $user->save();

            return $user;
        }

        return $user = null;
    }
}
