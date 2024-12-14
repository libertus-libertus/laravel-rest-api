<?php

use App\Http\Controllers\MapelController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\TeacherController;
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

// Route::apiResource('students', StudentController::class);
Route::apiResource('/student', StudentController::class);
Route::apiResource('/teacher', TeacherController::class);
Route::apiResource('/mapel', MapelController::class);
