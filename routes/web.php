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
Route::controller(UserProfileController::class)->prefix("user_profile")->group(function(){
    Route::get("/{user_id}","user_profile_show")->name("user_profile_show");
    Route::get("image_edit/{user_id}","image_edit_show")->name("image_edit_show");
    Route::post("image_edit/{user_id}","image_edit_function")->name("image_edit_function");
    Route::get("phone_number_edit/{user_id}","phone_number_edit_show")->name("phone_number_edit_show");
    Route::post("phone_number_edit/{user_id}","phone_number_edit_function")->name("phone_number_edit_function");
    Route::get("name_edit/{user_id}","name_edit_show")->name("name_edit_show");
    Route::post("name_edit/{user_id}","name_edit_function")->name("name_edit_function");
    Route::get("email_edit/{user_id}","email_edit_show")->name("email_edit_show");
    Route::post("email_edit/{user_id}","email_edit_function")->name("email_edit_function");
});

require __DIR__.'/auth.php';

Route::view('test', 'test');
