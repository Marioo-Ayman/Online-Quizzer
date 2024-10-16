<?php

use App\Models\User;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\QuizController;
use App\Http\Controllers\UserProfileController;

Route::get('/', [HomeController::class,'index'])->name("home");

Route::middleware('auth')->group(function () {

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});
//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
Route::controller(UserProfileController::class)->prefix("user_profile")->group(function () {
        Route::get("", "user_profile_show")->name("user_profile_show");
        Route::get("image_edit", "image_edit_show")->name("image_edit_show");
        Route::post("image_edit", "image_edit_function")->name("image_edit_function");
        Route::get("phone_number_edit", "phone_number_edit_show")->name("phone_number_edit_show");
        Route::post("phone_number_edit", "phone_number_edit_function")->name("phone_number_edit_function");
        Route::get("name_edit", "name_edit_show")->name("name_edit_show");
        Route::post("name_edit", "name_edit_function")->name("name_edit_function");
        Route::get("email_edit", "email_edit_show")->name("email_edit_show");
        Route::get("display_all_quizzes", "display_all_quizzes")->name("display_all_quizzes");
        Route::post("email_edit", "email_edit_function")->name("email_edit_function");
        Route::post('search_quiz_user',"search_quiz_user")->name("search_quiz_user");
        Route::delete('delete-account',  'deleteAccount')->name('delete-account');

});


require __DIR__ . '/auth.php';

///////////////////////////////////////////////////////////////////////////////////////////////
Route::get('/feedback',[AdminController::class,"feedback_view"])->name("feedback_view");
Route::post('/feedback',[AdminController::class,"feedback"])->name("feedback");
///////////////////////////////////////////////////////////////////////////////////////////////

Route::get('/dashboard', function () {
    return view('admin.index');
})->middleware(['auth', 'verified', 'admin'])->name('dashboard');

Route::get('admin/profile', [UserProfileController::class,'user_profile_show'])->middleware('auth')->name('admin.profile');

Route::group(['prefix' => 'admin', 'middleware' => ['admin', 'auth']], function () {
    Route::controller(AdminController::class)->group(function () {
        Route::get('logout', 'AdminLogout')->name('admin.logout');
        Route::get('contact', 'contact_to_admin')->name('admin.contact');
        Route::get('all_users', 'getAllUsers')->name('admin.getAllUsers');
        Route::get('all_users/search', 'search')->name('admin.getAllUsers.search');
        Route::get('getUser/{id}', 'getUser')->name('admin.getUser');
        Route::get('countOfUsers', 'countOfUsers')->name('admin.countOfUsers'); // count of users

        Route::get('admin/dashboard/all_quizes',"all_quizes")->name("admin.all_quizes");
        Route::post('admin/dashboard/all_quizes',"search_quiz")->name("search_quiz");
        Route::get('admin/dashboard/all_quizes/show_quiz/{quiz_id}',"show_quiz")->name("admin.show_quiz");

    });

    Route::controller(QuizController::class)->group(function () {
        Route::get('quiz/select', 'selectForm')->name('admin.quiz.selectForm');
        Route::post('quiz/setup', 'setupQuiz')->name('admin.quiz.setup');
        Route::get('quiz/create', 'createQuizForm')->name('admin.quiz.createForm');
        Route::post('quiz/store', 'store')->name('admin.quiz.store');
        Route::get('quiz/quizzes', 'showQuizzes')->name('admin.quizzes.show');

        Route::get('quiz/{id}/edit', 'editQuizForm')->name('admin.quiz.editForm');
        Route::put('quiz/{id}/update', 'update')->name('admin.quiz.update');

        Route::delete('quiz/{id}/destroy', 'destroy')->name('admin.quiz.destroy');
    });
});




Route::post('/user/login', [UserController::class, 'store'])->middleware('auth')->name('user.login');
Route::get('/user/logout', [UserController::class, 'logout'])->middleware('auth')->name('user.logout');

Route::get('/user/quiz/{studentId}/{quizId}', [QuizController::class, 'showQuiz'])->name('user.quiz.show');
Route::post('/user/quiz/{studentId}/{quizId}/submit', [QuizController::class, 'submitQuiz'])->name('user.quiz.submit');
Route::get('/user/quiz/{studentId}/{quizId}/retake', [QuizController::class, 'retakeQuiz'])->name('user.quiz.retake');




Route::get('/quiz/create', [QuizController::class, 'createQuizForm'])->name('quiz.createForm');
Route::post('/quiz/store', [QuizController::class, 'store'])->name('quiz.store');


Route::get('admin/dashboard/all_quizes',[AdminController::class,"all_quizes"])->name("admin.all_quizes");
Route::post('admin/dashboard/all_quizes',[AdminController::class,"search_quiz"])->name("search_quiz");
Route::get('admin/dashboard/all_quizes/show_quiz/{quiz_id}',[AdminController::class,"show_quiz"])->name("admin.show_quiz");
Route::get('home/quizzes/{topic_id}',[AdminController::class,"quizzees_with_topic"])->name("quizzees_with_topic");
Route::post('home/quizzes/{topic_id}',[AdminController::class,"search_specific_topic_quiz"])->name("search_specific_topic_quiz");
