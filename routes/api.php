<?php

use App\Http\Controllers\AttendanceController;
use App\Http\Controllers\KeyHistoryController;
use App\Http\Controllers\RoomController;
use App\Http\Controllers\SectionController;
use App\Http\Controllers\SemesterController;
use App\Http\Controllers\SubjectController;
use App\Http\Controllers\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::controller(UserController::class)->group(function () {
    Route::get('/users', 'index')->name('users.index'); // show all faculties and checkers
    Route::post('/users', 'store')->name('users.store'); // create new user
    Route::get('/users/login/{id}', 'login')->name('users.login'); // show login form
    Route::post('/users/authenticate', 'authenticate')->name('users.authenticate'); // user log in
});

Route::controller(SectionController::class)->group(function () {
    Route::get('/sections', 'index')->name('sections.index'); // // show all sections
    Route::post('/sections', 'store')->name('sections.store'); // // store new section
});

Route::controller(SubjectController::class)->group(function () {
    Route::get('/subjects', 'index')->name('subjects.index'); // // show all subjects
    Route::post('/subjects', 'store')->name('subjects.store'); // // store new subject
});

Route::controller(SemesterController::class)->group(function () {
    Route::get('/semesters', 'index')->name('semesters.index'); // // show all semesters
    Route::post('/semesters', 'store')->name('semesters.store'); // // store new semester
});


Route::controller(AttendanceController::class)->group(function () {
    Route::get('/attendances', 'index')->name('attendances.index'); // // show all attendances / schedules
    Route::post('/attendances', 'store')->name('attendances.store'); // // store new attendance/ schedule
});

Route::controller(RoomController::class)->group(function () {
    Route::get('/rooms', 'index')->name('rooms.index'); // show all rooms - [available or borrowed]
    Route::post('/rooms', 'store')->name('rooms.store'); // // store new room
});

Route::controller(KeyHistoryController::class)->group(function () {
    Route::get('/keys', 'index')->name('keys.index'); // show all key history
    Route::post('/keys', 'store')->name('keys.store'); // store new key history
    Route::get('/keys/{id}', 'show')->name('keys.show'); // show single key history
});
