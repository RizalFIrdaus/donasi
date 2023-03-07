<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\Akun\ProfileController;

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
Route::middleware("auth")->group(function () {
    Route::get("/user/profil", [ProfileController::class, "profile"])->name("change-profile");
    Route::post("/user/profil", [ProfileController::class, "updateProfile"])->name("update-profile");
    Route::get("/user/account", [ProfileController::class, "account"])->name("change-personal-account");
    Route::get("/user/account/email", [ProfileController::class, "email"])->name("change-email");
    Route::post("/user/account/email", [ProfileController::class, "updateEmail"])->name("update-email");
    Route::get("/user/account/password", [ProfileController::class, "password"])->name("change-password");
    Route::post("/user/logout", [AuthController::class, "logout"])->name("logout");
});

Route::middleware("guest")->controller(AuthController::class)->group(function () {
    Route::get("/user/login",  "login")->name("login");
    Route::post("/user/login",  "doLogin")->name("doLogin");
    Route::get("/user/register",  "register")->name("register");
    Route::post("/user/register",  "doRegister")->name("doRegister");
});
