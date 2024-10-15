<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Mail\SendEmail;
use App\Models\Quiz;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Password;
use Illuminate\Validation\ValidationException;
use App\Models\Topic;
use APP\Mail\PostMail;
use function PHPUnit\Framework\returnValue;

class AdminController extends Controller
{
    function index(){


            if(Auth::user()->role == "admin"){
                $user = User::all();

                return view('admin.index', ['user'=>$user]);
            }

            return redirect()->back();
        
        }


        public function profile(){

            $id = Auth::user()->id;
            $userData =User::findOrFail($id);
            if (Auth::user()->role ==="admin") {
                # code...
                return view('admin.adminProfileView', compact('userData'));
            }

            return redirect('/');
        }


    public function AdminLogout(Request $request)
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/login');
    }

    public function contact_to_admin(){
        return view('auth.contactWithAdmin');
    }
         public function sendEmail(Request $request)
        {
            // ini_set('max_execution_time', 120);

            $request->validate([
                'email' => 'required|email',
            ]);

            // Log the email for debugging
            Log::info("Attempting to send email to: " . $request->email);

            // Mail::to($request->email)->queue(new SendEmail($request->email));
            Mail::to($request->email)->send(new SendEmail($request->email));

            Log::info("Email dispatched to queue.");

            return view('auth.email_message');
        }

        public function getAllUsers(){
             $users = DB::select("
            SELECT
                users.id as user_id,
                users.name,
                users.email,
                users.phone,
                users.image,
                GROUP_CONCAT(quizzes.title SEPARATOR ', ') as quiz_titles,
                GROUP_CONCAT(users_score.user_score SEPARATOR ', ') as scores
            FROM
                users
            JOIN
                users_score ON users.id = users_score.user_id
            JOIN
                quizzes ON users_score.quiz_id = quizzes.id
            GROUP BY
                users.id, users.name, users.email, users.phone, users.image
        ");



            // dd($users);

            return view('admin.showUsers', compact('users'));
            // return view('admin.showUsers', ['users'=>$users, 'numberOfUsers'=>$numberOfUsers]);
        }

        public function search(Request $request){
            $keyword  = $request->keyword;
            $users = User::where('name', 'like', "%$keyword%")->get();
            dd($users);
            return response()->json($users);
        }


        public function getUser($id) {
            $user = DB::select("
                SELECT
                    users.id as user_id,
                    users.name,
                    users.email,
                    users.phone,
                    users.image,
                    GROUP_CONCAT(quizzes.title SEPARATOR ', ') as quiz_titles,
                    GROUP_CONCAT(users_score.user_score SEPARATOR ', ') as scores
                FROM
                    users
                JOIN
                    users_score ON users.id = users_score.user_id
                JOIN
                    quizzes ON users_score.quiz_id = quizzes.id
                WHERE
                    users.id = ?
                GROUP BY
                    users.id, users.name, users.email, users.phone, users.image
            ", [$id]);

            // Ensure you only get the first user (since we expect a single user here)
            $user = $user ? $user[0] : null;

            return view('admin.showSpecificUser', compact('user', 'id'));
        }


        public function countOfUsers(){
            $userCount = User::where('role', 'user')->count(); // Count users
            dd($userCount);
            return view('admin.content', ['userCount' => $userCount]); // Pass to view
        }





        //////////////////////////////abanoub////////////////////////////////////
        function all_quizes(){
        $quizes=Quiz::where("user_id",Auth::user()->id)->paginate(10);
        return view("admin.all_quizes",["quizes"=>$quizes]);
        }

        public function show_quiz($quiz_id)
         {
            $studentsWithScores = DB::table('users_score')
                ->join('users', 'users_score.user_id', '=', 'users.id')
                ->join('quizzes', 'users_score.quiz_id', '=', 'quizzes.id')
                ->where('users_score.quiz_id', $quiz_id)
                ->select(
                    'users_score.*',
                    'users.name',
                    'users.email',
                    'users.phone',
                    'users.image',
                    'quizzes.title',
                    'quizzes.description'
                )
                ->orderBy('users_score.user_score', 'desc')
                ->paginate(10);

            return view("admin.show_quiz", ["students" => $studentsWithScores]);
         }



         public function search_quiz(Request $request)
         {
            $result = Quiz::where('title', 'like', '%' . $request->input('search_quiz') . '%')
            ->orWhere('description', 'like', '%' . $request->input('search_quiz') . '%')
            ->paginate(10);
            return view('admin.all_quizes', ['quizes' => $result]);
         }

    

         function quizzees_with_topic($topic_id){
            $quizes=Quiz::where("topic_id",$topic_id)->paginate(10);
            $topic_name=Topic::find($topic_id);
            return view("admin.quizzees_with_topic",["quizes"=>$quizes,"topic_name"=>$topic_name]);
            }
            public function search_specific_topic_quiz(Request $request,$topic_id)
         {
            $result = Quiz::where('title', 'like', '%' . $request->input('search_quiz') . '%')
            ->orWhere('description', 'like', '%' . $request->input('search_quiz') . '%')
            ->where("topic_id",$topic_id)
            ->paginate(10);
            $topic_name=Topic::find($topic_id);
            return view('admin.quizzees_with_topic', ['quizes' => $result,"topic_name"=>$topic_name]);
         }
        
         // Controller methods

// Display the feedback form
function feedback_view(){
    return view("feedback.feedback");
}

// Handle feedback submission and send the email
function feedback(Request $request){
    // Get the admin user
    $admin = User::where("role", "admin")->first();
    
    // Get feedback from the request
    $feedback = $request->feedback;
    session(["feedback"=>$feedback]);
    // Ensure there is an admin user found
    if ($admin) {
        // Send email to admin using PostMail
        Mail::to($admin->email)->send(new \App\Mail\PostMail($feedback));
        
        // Redirect to the home page
        return redirect('/')->withMesage("message","feedback was sent successfully");
    } else {
        // Handle case if no admin found
        return back()->with('error', 'Admin user not found.');
    }
}

}


