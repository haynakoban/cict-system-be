<?php

namespace App\Http\Controllers;

use App\Models\KeyHistory;
use App\Models\Room;
use App\Models\Semester;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class KeyHistoryController extends Controller
{
    public function index()
    {
        $histories = DB::table('key_histories')
            ->join('rooms', 'rooms.id', '=', 'key_histories.room_id')
            ->join('users', 'users.id',  '=', 'key_histories.user_id')
            ->select('key_histories.id as key_id', 'key_histories.*' , 'rooms.room_name', 'users.first_name', 'users.last_name')
            ->where('users.role_type', 2)
            ->get();

        $semesters = Semester::all();

        return response()->json(['histories' => $histories, 'semesters' => $semesters]);
    }

    public function show($id)
    {
        $room = Room::where('id', $id)->first();

        $users = DB::table('users')->where('users.role_type', 2)->get();

        return response()->json(['room' => $room, 'users' => $users]);
    }

    public function store(Request $request)
    {
        $room = Room::where('id', $request->room_id)->first();

        $room->room_status = $request->room_status == 'available' ? 'borrowed' : 'available';
        $room->save();

        $history = KeyHistory::create([
            'room_id' => $request->room_id,
            'user_id' => $request->user_id,
            'semester_id' => $request->semester_id,
            'key_time' => now('Asia/Manila'),
            'key_status' => $request->room_status == 'available' ? 'Borrowed' : 'Returned',
        ]);

        return response()->json(['message' => 'success', 'history' => $history]);  

    }
}
