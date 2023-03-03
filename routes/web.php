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
})->middleware("auth");
Route::middleware("auth")->group(function () {
    Route::post("/user/logout", [AuthController::class, "logout"])->name("logout");
});

Route::middleware("guest")->controller(AuthController::class)->group(function () {
    Route::get("/user/login",  "login")->name("login");
    Route::post("/user/login",  "doLogin")->name("doLogin");
    Route::get("/user/register",  "register")->name("register");
    Route::post("/user/register",  "doRegister")->name("doRegister");
});
