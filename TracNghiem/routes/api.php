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
use App\Http\Controllers\Auth\AuthController;


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


Route::middleware('auth:sanctum')->group(function () {
    Route::get('/logout', [AuthController::class, 'logout'])->name('logout.api');
    Route::prefix('exam')->group(function (){
        Route::get('/', [ExamController::class, 'list'])->name('exam.list.api');
        Route::get('/{exam}', [ExamController::class, 'find'])->name('exam.find.api');
        Route::post('/submit', [ExamController::class, 'submitExam'])->name('exam.submit.api');
    });
   
});

Route::post('/register', [AuthController::class, 'register'])->name('register.api');
Route::post('/login', [AuthController::class, 'login'])->name('login.api');
