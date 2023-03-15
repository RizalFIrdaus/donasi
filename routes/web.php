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
    Route::get("/donation", "donasi")->name("donasi");
    Route::get("/donation/{slug}", "detail")->name("donasi.detail");
});

Route::prefix("/campaign/medical")->controller(GalangDanaController::class)->middleware("auth")->group(function () {
    Route::get("step1", "step1")->name("step1.medical.pasien");
    Route::post("step1", "storeStep1")->name("store.step1.medical.pasien");
    Route::get("step2", "step2")->name("step2.medical.tujuan");
    Route::post("step2", "storeStep2")->name("store.step2.medical.tujuan");
    Route::get("step3", "step3")->name("step3.medical.riwayatmedis");
    Route::post("step3", "storeStep3")->name("store.step3.medical.riwayatmedis");
    Route::get("step4", "step4")->name("step4.medical.targetdonasi");
    Route::post("step4", "storeStep4")->name("store.step4.medical.targetdonasi");
    Route::get("step5", "step5")->name("step5.medical.judul");
    Route::post("step5", "storeStep5")->name("store.step5.medical.judul");
    Route::get("review", "review")->name("review.medical");
    Route::post("review", "finalReview")->name("post.review.medical");
});
Route::prefix("/user")->middleware("auth")->group(function () {
    Route::controller(ProfileController::class)->group(function () {
        Route::get("profil", "profile")->name("change-profile");
        Route::post("profil", "updateProfile")->name("update-profile");
        Route::get("account", "account")->name("change-personal-account");
        Route::get("account/email", "email")->name("change-email");
        Route::post("account/email", "updateEmail")->name("update-email");
        Route::get("account/password", "password")->name("change-password");
        Route::post("account/password", "updatePassword")->name("update-password");
        Route::get("campaign", "campaign")->name("campaign-profile");
        Route::post("campaign/review/{id}", "campaignReview")->name("campaign-review");
        Route::post("campaign/active/{id}", "campaignActive")->name("campaign-active");
        Route::post("campaign/delete/{id}", "campaignDelete")->name("campaign-delete");
    });
    Route::post("logout", [AuthController::class, "logout"])->name("logout");
});

Route::prefix("/user")->middleware("guest")->controller(AuthController::class)->group(function () {
    Route::get("login",  "login")->name("login");
    Route::post("login",  "doLogin")->name("doLogin");
    Route::get("register",  "register")->name("register");
    Route::post("register",  "doRegister")->name("doRegister");
});
