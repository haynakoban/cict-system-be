<?php

namespace App\Http\Controllers;

use App\Models\KeyHistory;
use App\Models\Room;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class RoomController extends Controller
{
    public function index()
    {
        $rooms = Room::all();  

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
                    ->where('users.user_role_type', 2) // select faculty only
                    ->get();

        return response()->json([
            'rooms' => $rooms,
            'users' => $users,
            'keys' => $keys,
        ]);
    }

    public function store(Request $request) {

        $room = Room::where('id', $request->room_id)->first();

        $room->status = $request->room_status == 'available' ? 'borrowed' : 'available';
        $room->save();

        KeyHistory::create([
            'room_id' => $request->room_id,
            'user_id' => $request->user_id,
            'semester_id' => $request->semester_id,
            'key_time' => now('Asia/Manila'),
            'key_status' => $request->room_status == 'available' ? 'Borrowed' : 'Returned',
        ]);

        return response()->json(['message' => 'new key created']);
    }
}
