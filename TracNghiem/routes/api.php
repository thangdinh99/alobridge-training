<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\ExamController;
use App\Http\Controllers\QuestionController;
use App\Http\Controllers\ResultController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\LogoutController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/
Route::post('login', 'AuthController@login');

Route::middleware('auth:sanctum')->group(function (){
    Route::get('/logout', [LogoutController::class,'logout'])->name('logout.api');
    Route::get('/user', [UserController::class,'userdata'])->name('user.api');
});
Route::post('/register', [RegisterController::class,'register'])->name('register.api');
Route::post('/login', [LoginController::class,'login']);
Route::get('/exam', [ExamController::class,'list'])->name('exam.list.api');
Route::post('/exam', [ExamController::class,'find'])->name('exam.find.api');
Route::get('/usertest', function () {
    return response()->json(['message' => 'User data'], 200);
});