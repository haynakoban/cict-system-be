<?php

namespace App\Http\Controllers;

use App\Models\KeyHistory;
use App\Models\Room;
use App\Models\Semester;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class RoomController extends Controller
{
    public function index()
    {
        $rooms = DB::table('rooms')
                ->join('semesters', 'semesters.id', '=', 'rooms.semester_id')
                ->select('rooms.id as room_id', 'rooms.*', 'semesters.*')
                ->get();

        $rooms_id = Room::where('room_status', 'borrowed')
                ->get()
                ->pluck('id')
                ->toArray();

        $keys_id = DB::table('key_histories')
                ->whereIn('room_id', $rooms_id)
                ->select(DB::raw('MAX(id) AS id'))
                ->groupBy('room_id')
                ->get()
                ->pluck('id')
                ->toArray();
                
        $keys = DB::table('key_histories')
                ->join('users', 'users.id', '=', 'key_histories.user_id')
                ->whereIn('key_histories.id', $keys_id)
                ->get();

        $users = DB::table('users')
                    ->where('users.role_type', 2) // select faculty only
                    ->get();

        $semesters = Semester::all();            

        return response()->json([
            'rooms' => $rooms,
            'users' => $users,
            'keys' => $keys,
            'semesters' => $semesters,
        ]);
    }

    public function store(Request $request) {

        $room = Room::create([
            'semester_id' => $request->semester_id,
            'room_name' => $request->room_name,
        ]);

        return response()->json(['message' => 'new room created', 'room' => $room]); 
    }

    public function update(Request $request)
    {
        $room = Room::where('id', $request->room_id)->first();
        $room->room_name = $request->room_name;
        $room->save();

        return response()->json(['message' => 'room updated', 'room' => $room]); 
    }

    public function delete(Request $request)
    {
        Room::where('id', $request->room_id)->delete();

        return response()->json(['message' => 'room deleted']); 
    }
}
