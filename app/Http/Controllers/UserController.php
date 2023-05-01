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

     public function update(Request $request)
    {
        $user = User::where('id', $request->user_id)->first();

        $user->username = $request->username;
        $user->email = $request->email;
        $user->first_name = $request->first_name;
        $user->last_name = $request->last_name;
        $user->middle_name = $request->middle_name;
        $user->position = $request->position;
        $user->course_program = $request->course_program;
        $user->address = $request->address;
        $user->age = $request->age;
        $user->dob = $request->dob;

        $user->save();

        return response()->json(['message'=> 'success', 'user' => $user]);
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

    public function logout(Request $request)
    {
        $user = User::where('id', $request->id)->first();
        $user->last_login = now('Asia/Manila');
        $user->status = 'offline';
        $user->save();

        auth()->logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return response()->json(['message' => 'You have been logged out']);
    }

    public function upload(Request $request)
    {
        $user = User::where('id', $request->input('id'))->first();

        if ($request->hasFile('file')) {
            $file = $request->file('file')->store('images', 'public');
            $user->image_url = $file;
            $user->save();
        
            return response()->json(['message' => 'File uploaded successfully.']);
            
        } 
            
        else {

            return response()->json(['error' => 'No file uploaded.'], 400);

        }
    }

    public function checkUsername($id)
    {
        $user = User::where('username', $id)->first();

        if ($user) {
            return response()->json(['error' => true]);
        } else {
             return response()->json(['error' => false]);
        }
    }

    public function checkEmail($id)
    {
        $user = User::where('email', $id)->first();

        if ($user) {
            return response()->json(['error' => true]);
        } else {
             return response()->json(['error' => false]);
        }
    }
}
