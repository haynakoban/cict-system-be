<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KeyHistory extends Model
{
    use HasFactory;

    protected $fillable = [
        'room_id',
        'user_id',
        'semester_id',
        'key_time',
        'key_status' 
    ];
}
