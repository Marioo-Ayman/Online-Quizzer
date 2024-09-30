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


Route::get('/quiz/select', [QuizController::class, 'selectForm'])->name('quiz.selectForm');
Route::post('/quiz/setup', [QuizController::class, 'setupQuiz'])->name('quiz.setup');

Route::get('/quiz/create', [QuizController::class, 'createQuizForm'])->name('quiz.createForm');
Route::post('/quiz/store', [QuizController::class, 'store'])->name('quiz.store');

