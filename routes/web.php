<?php

use App\Http\Controllers\Admin\AdminController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Auth\PasswordController;
use App\Http\Controllers\Auth\NewPasswordController;
use App\Http\Controllers\Auth\VerifyEmailController;
use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\Auth\PasswordResetLinkController;
use App\Http\Controllers\Auth\ConfirmablePasswordController;
use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Auth\EmailVerificationPromptController;
use App\Http\Controllers\Auth\EmailVerificationNotificationController;
use App\Http\Controllers\UserController;
use App\Http\Middleware\RoleMiddleware;



Route::get('/', function () {
    return view('welcome');
});

// Route::middleware('guest')->group(function () {
//     Route::get('register', [RegisteredUserController::class, 'create'])
//                 ->name('register');
//     Route::post('register', [RegisteredUserController::class, 'store']);
//     Route::get('login', [AuthenticatedSessionController::class, 'create'])
//                 ->name('login');
//     Route::post('login', [AuthenticatedSessionController::class, 'store']);
//     Route::get('forgot-password', [PasswordResetLinkController::class, 'create'])
//                 ->name('password.request');
//     Route::post('forgot-password', [PasswordResetLinkController::class, 'store'])
//                 ->name('password.email');
//     Route::get('reset-password/{token}', [NewPasswordController::class, 'create'])
//                 ->name('password.reset');
//     Route::post('reset-password', [NewPasswordController::class, 'store'])
//                 ->name('password.store');
// });


// Route::middleware('auth')->group(function () {
//     Route::get('verify-email', EmailVerificationPromptController::class)
//                 ->name('verification.notice');
//     Route::get('verify-email/{id}/{hash}', VerifyEmailController::class)
//                 ->middleware(['signed', 'throttle:6,1'])
//                 ->name('verification.verify');
//     Route::post('email/verification-notification', [EmailVerificationNotificationController::class, 'store'])
//                 ->middleware('throttle:6,1')
//                 ->name('verification.send');
//     Route::get('confirm-password', [ConfirmablePasswordController::class, 'show'])
//                 ->name('password.confirm');
//     Route::post('confirm-password', [ConfirmablePasswordController::class, 'store']);
//     Route::put('password', [PasswordController::class, 'update'])->name('password.update');
//     Route::post('logout', [AuthenticatedSessionController::class, 'destroy'])
//                 ->name('logout');
// });



Route::get('/dashboard', function () {
    return view('admin.index');
    // return view('dashboard');
})->middleware(['auth' ,'verified'])->name('dashboard');


// admin logout
    // Route::post('admin/login', [AdminController::class, 'index'])->name('admin.login');
    // Route::get('admin/logout', [AdminController::class, 'AdminLogout'])->name('admin.logout');

Route::middleware('auth')->group(function () {
Route::get('admin/logout', [AdminController::class, 'AdminLogout'])->name('admin.logout');


    // Route::get('/admin/dashboard', [AdminController::class, 'index'])->name('admin.dashboard');

    // Route::get('/admin/dashboard', [AdminDashboardController::class, 'index']);
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';



// // route for the admin
// Route::get('admin/dashboard', [AdminDashboardController::class, 'index'])
//     ->middleware('auth', 'is_admin:admin')
//     ->name('admin.dashboard');

Route::get('/admin/dashboard', [AdminController::class, 'index'])->middleware('auth','role:admin')->name('admin.dashboard');

                    // rolemiddleware name
    // ->middleware(['auth', 'role:admin'])

    Route::get('/user/show', [UserController::class, 'login'])->middleware('auth','role:user')->name('user.show');
    Route::post('/user/login', [UserController::class, 'store'])->middleware('auth','role:user')->name('user.login');
    Route::get('/user/logout', [UserController::class, 'logout'])->middleware('auth','role:user')->name('user.logout');


// ->middleware('auth','role:user')


