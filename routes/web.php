<?php

use App\Models\User;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\UserProfileController;

Route::get('/', function () {
    return view('welcome');
});




Route::middleware('auth')->group(function () {

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});
//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
Route::controller(UserProfileController::class)->prefix("user_profile")->group(function(){
    Route::get("{user_id}",[UserProfileController::class,"user_profile_show"])->name("user_profile_show");
    Route::get("image_edit/{user_id}",[UserProfileController::class,"image_edit_show"])->name("image_edit_show");
    Route::post("image_edit/{user_id}",[UserProfileController::class,"image_edit_function"])->name("image_edit_function");
    Route::get("phone_number_edit/{user_id}",[UserProfileController::class,"phone_number_edit_show"])->name("phone_number_edit_show");
    Route::post("phone_number_edit/{user_id}",[UserProfileController::class,"phone_number_edit_function"])->name("phone_number_edit_function");
    Route::get("name_edit/{user_id}",[UserProfileController::class,"name_edit_show"])->name("name_edit_show");
    Route::post("name_edit/{user_id}",[UserProfileController::class,"name_edit_function"])->name("name_edit_function");
    Route::get("email_edit/{user_id}",[UserProfileController::class,"email_edit_show"])->name("email_edit_show");
    Route::post("email_edit/{user_id}",[UserProfileController::class,"email_edit_function"])->name("email_edit_function");
});

require __DIR__.'/auth.php';

Route::view('test', 'test');


Route::get('/dashboard', function () {
    return view('admin.index');
})->middleware(['auth', 'verified'])->name('dashboard');


// Route::get('/admin/dashboard', [AdminController::class, 'index'])->middleware('auth','roleMiddleware:admin')->name('admin.dashboard');

Route::middleware('auth', 'adminMiddleware')->group(function(){
    Route::get('admin/logout', [AdminController::class, 'AdminLogout'])->name('admin.logout');
    Route::get('admin/profile', [AdminController::class, 'profile'])->name('admin.profile');
//send email to admin
    Route::get('/admin/contact', [AdminController::class, 'contact_to_admin'])->name('admin.contact');
    Route::post('/admin/sendEmail', [AdminController::class, 'sendEmail'])->name('admin.sendEmail');
    Route::get('/admin/dashboard', [AdminController::class, 'index'])->name('admin.dashboard');

});


Route::middleware('auth', 'roleMiddleware')->group(function(){

// Route::get('/user/show', [UserController::class, 'login'])->middleware('auth','roleMiddleware:user')->name('user.show');

// Route::get('/user/show', [UserController::class, 'login'])->middleware('auth')->name('user.show');
// Route::post('/user/login', [UserController::class, 'store'])->middleware('auth')->name('user.login');
Route::get('/user/logout', [UserController::class, 'logout'])->middleware('auth')->name('user.logout');
});
