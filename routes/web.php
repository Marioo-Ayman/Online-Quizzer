<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserProfileController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});
//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
Route::get("user_profile/{user_id}",[UserProfileController::class,"user_profile_show"])->name("user_profile_show");
Route::get("user_profile/image_edit/{user_id}",[UserProfileController::class,"image_edit_show"])->name("image_edit_show");
Route::post("user_profile/image_edit/{user_id}",[UserProfileController::class,"image_edit_function"])->name("image_edit_function");
Route::get("user_profile/phone_number_edit/{user_id}",[UserProfileController::class,"phone_number_edit_show"])->name("phone_number_edit_show");
Route::post("user_profile/phone_number_edit/{user_id}",[UserProfileController::class,"phone_number_edit_function"])->name("phone_number_edit_function");
Route::get("user_profile/name_edit/{user_id}",[UserProfileController::class,"name_edit_show"])->name("name_edit_show");
Route::post("user_profile/name_edit/{user_id}",[UserProfileController::class,"name_edit_function"])->name("name_edit_function");
Route::get("user_profile/email_edit/{user_id}",[UserProfileController::class,"email_edit_show"])->name("email_edit_show");
Route::post("user_profile/email_edit/{user_id}",[UserProfileController::class,"email_edit_function"])->name("email_edit_function");

require __DIR__.'/auth.php';

Route::view('test', 'test');
