<?php

use App\Http\Controllers\Api\Akun\ProfileController;
use App\Http\Controllers\Api\Auth\AuthController;
use App\Http\Controllers\Api\Beranda\MedicalGalangDanaController;
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

Route::middleware("auth:sanctum")->group(function () {
    Route::post('/user/logout', [AuthController::class, 'Logout']);
    Route::post('/user/profil', [ProfileController::class, 'updateProfile']);
    Route::post('/user/account/email', [ProfileController::class, 'updateEmail']);
    Route::post('/user/account/password', [ProfileController::class, 'updatePassword']);
    Route::apiResource('/campaign', MedicalGalangDanaController::class);
});

Route::post('/user/register', [AuthController::class, 'Register']);
Route::post('/user/login', [AuthController::class, 'Login']);
