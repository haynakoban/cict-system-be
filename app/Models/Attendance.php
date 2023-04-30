<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Attendance extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'room_id',
        'section_id',
        'subject_id',
        'semester_id',
        'attendance_group',
        'attendance_status',
        'attendance_day',
        'attendance_start_time',
        'attendance_end_time',
        'attendance_comments',
    ];
}
