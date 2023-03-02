<?php

use App\Http\Controllers\Auth\AuthController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get("/", function () {
    return view("Beranda.index");
});

Route::get("/user/login", [AuthController::class, "login"])->name("login");
Route::post("/user/login", [AuthController::class, "doLogin"])->name("doLogin");
Route::get("/user/register", [AuthController::class, "register"])->name("register");
Route::post("/user/register", [AuthController::class, "doRegister"])->name("doRegister");
