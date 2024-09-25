<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\QuizController;
use Illuminate\Support\Facades\Route;


Route::get('/', function () {
    return view('welcome');
});


Route::get('/quiz/select', [QuizController::class, 'selectForm'])->name('quiz.selectForm');
Route::post('/quiz/setup', [QuizController::class, 'setupQuiz'])->name('quiz.setup');

Route::get('/quiz/create', [QuizController::class, 'createQuizForm'])->name('quiz.createForm');
Route::post('/quiz/store', [QuizController::class, 'store'])->name('quiz.store');
