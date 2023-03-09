<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\Akun\ProfileController;
use App\Http\Controllers\Beranda\DonasiController;
use App\Http\Controllers\Beranda\GalangDanaController;

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

Route::controller(DonasiController::class)->group(function () {
    Route::get("/", "index");
    Route::get("/campaign", "galangdana")->name("galang-dana")->middleware("auth");
});

Route::controller(GalangDanaController::class)->middleware("auth")->group(function () {
    Route::get("/campaign/medical/step1", "step1")->name("step1.medical.pasien");
    Route::post("/campaign/medical/step1", "storeStep1")->name("store.step1.medical.pasien");
    Route::get("/campaign/medical/step2", "step2")->name("step2.medical.tujuan");
    Route::post("/campaign/medical/step2", "storeStep2")->name("store.step2.medical.tujuan");
    Route::get("/campaign/medical/step3", "step3")->name("step3.medical.riwayatmedis");
    Route::post("/campaign/medical/step3", "storeStep3")->name("store.step3.medical.riwayatmedis");
    Route::get("/campaign/medical/step4", "step4")->name("step4.medical.targetdonasi");
    Route::post("/campaign/medical/step4", "storeStep4")->name("store.step4.medical.targetdonasi");
    Route::get("/campaign/medical/step5", "step5")->name("step5.medical.judul");
    Route::post("/campaign/medical/step5", "storeStep5")->name("store.step5.medical.judul");
    Route::get("/campaign/medical/review", "review")->name("review.medical");
    Route::post("/campaign/medical/review", "finalReview")->name("post.review.medical");
});
Route::middleware("auth")->group(function () {
    Route::get("/user/profil", [ProfileController::class, "profile"])->name("change-profile");
    Route::post("/user/profil", [ProfileController::class, "updateProfile"])->name("update-profile");
    Route::get("/user/account", [ProfileController::class, "account"])->name("change-personal-account");
    Route::get("/user/account/email", [ProfileController::class, "email"])->name("change-email");
    Route::post("/user/account/email", [ProfileController::class, "updateEmail"])->name("update-email");
    Route::get("/user/account/password", [ProfileController::class, "password"])->name("change-password");
    Route::post("/user/account/password", [ProfileController::class, "updatePassword"])->name("update-password");
    Route::post("/user/logout", [AuthController::class, "logout"])->name("logout");
});

Route::middleware("guest")->controller(AuthController::class)->group(function () {
    Route::get("/user/login",  "login")->name("login");
    Route::post("/user/login",  "doLogin")->name("doLogin");
    Route::get("/user/register",  "register")->name("register");
    Route::post("/user/register",  "doRegister")->name("doRegister");
});
