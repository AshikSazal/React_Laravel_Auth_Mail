<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\ForgetController;
use App\Http\Controllers\ResetController;
use App\Http\Controllers\Usercontroller;
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

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });

// Login route
Route::post('/login',[AuthController::class, 'login']);

// Register route
Route::post('/registration',[AuthController::class, 'registration']);

// Forget password route
Route::post('/forgetpassword',[ForgetController::class, 'forgetpassword']);

// Reset password route
Route::post('/resetpassword',[ResetController::class, 'resetpassword']);

// Current user route
Route::middleware('auth:sanctum')->get('/user',[Usercontroller::class, 'user']);

// Current user route
Route::middleware('auth:sanctum')->post('/logout',[AuthController::class, 'logout']);
