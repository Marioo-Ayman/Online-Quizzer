<?php

use App\Models\User;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\QuizController;
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
Route::controller(UserProfileController::class)->prefix("user_profile")->group(function () {
    Route::get("/{user_id}", "user_profile_show")->name("user_profile_show");
    Route::get("image_edit/{user_id}", "image_edit_show")->name("image_edit_show");
    Route::post("image_edit/{user_id}", "image_edit_function")->name("image_edit_function");
    Route::get("phone_number_edit/{user_id}", "phone_number_edit_show")->name("phone_number_edit_show");
    Route::post("phone_number_edit/{user_id}", "phone_number_edit_function")->name("phone_number_edit_function");
    Route::get("name_edit/{user_id}", "name_edit_show")->name("name_edit_show");
    Route::post("name_edit/{user_id}", "name_edit_function")->name("name_edit_function");
    Route::get("email_edit/{user_id}", "email_edit_show")->name("email_edit_show");
    Route::post("email_edit/{user_id}", "email_edit_function")->name("email_edit_function");
});

require __DIR__ . '/auth.php';

Route::view('test', 'test');


Route::get('/dashboard', function () {
    return view('admin.index');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::controller(AdminController::class)->prefix('admin')->group(function () {

    Route::get('dashboard', 'index')->middleware('auth', 'adminMiddleware:admin')->name('admin.dashboard');
    Route::get('profile', 'profile')->middleware('auth')->name('admin.profile');
    Route::get('logout', 'AdminLogout')->middleware('auth')->name('admin.logout');
    Route::get('contact', 'contact_to_admin')->middleware('auth')->name('admin.contact');

    Route::get('all_users', 'getAllUsers')->middleware('auth')->name('admin.getAllUsers');

    Route::get('all_users/search', 'search')->middleware('auth')->name('admin.getAllUsers.search');
    // Route::get('all_users/search/{keyword}','search')->middleware('auth')->name('admin.getAllUsers');
    Route::get('getUser/{id}', 'getUser')->middleware('auth')->name('admin.getUser');
    Route::get('countOfUsers', 'countOfUsers')->middleware('auth')->name('admin.countOfUsers'); //count of users

    Route::get('/quiz/select', [QuizController::class, 'selectForm'])->name('admin.quiz.selectForm');
    Route::post('/quiz/setup', [QuizController::class, 'setupQuiz'])->name('admin.quiz.setup');

    Route::get('/quiz/create', [QuizController::class, 'createQuizForm'])->name('admin.quiz.createForm');
    Route::post('/quiz/store', [QuizController::class, 'store'])->name('admin.quiz.store');

    Route::get('/quiz/quizzes', [QuizController::class, 'showQuizzes'])->name('admin.quizzes.show');
});


Route::get('/user/show', [UserController::class, 'login'])->middleware('auth', 'role:user')->name('user.show');
Route::post('/user/login', [UserController::class, 'store'])->middleware('auth', 'role:user')->name('user.login');
Route::get('/user/logout', [UserController::class, 'logout'])->middleware('auth', 'role:user')->name('user.logout');

Route::get('/user/quiz/{studentId}/{quizId}', [QuizController::class, 'showQuiz'])->name('user.quiz.show');
Route::post('/user/quiz/{studentId}/{quizId}/submit', [QuizController::class, 'submitQuiz'])->name('user.quiz.submit');
Route::get('/user/quiz/{studentId}/{quizId}/retake', [QuizController::class, 'retakeQuiz'])->name('user.quiz.retake');

