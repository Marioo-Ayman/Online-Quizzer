<?php

namespace App\Http\Controllers;

use App\Models\Quiz;
use App\Models\Topic;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    // public function index()
    // {

    //     $topics = Topic::get(['id', 'name']);
    //     $quizzes = Quiz::select('quizzes.id', 'quizzes.title', 'quizzes.description', 'users.name as author', 'topic_id')
    //         ->join('users', 'quizzes.user_id', '=', 'users.id')
    //         ->get();

    //     $topics = $topics->toArray();
    //     $quizzes = $quizzes->toArray();

    //     $data = [];
    //     foreach ($topics as &$topic) {
    //         $topic['quizzes'] = [];
    //         foreach ($quizzes as $quiz) {
    //             if ($topic['id'] == $quiz['topic_id']) {
    //                 $topic['quizzes'][] = $quiz;
    //             }
    //         }
    //     }

    //     return view('home', [
    //         'topics' => $topics
    //     ]);
    // }
    public function index()
    {


        $topics = Topic::get(['id', 'name']);

        // Get current user
        $user = Auth::user();

        // Check if the user is logged in and is an admin
        if ($user && $user->role ==="admin") {
            // Admin can see all quizzes
            $quizzes = Quiz::select('quizzes.id', 'quizzes.title', 'quizzes.description', 'users.name as author', 'topic_id')
                ->join('users', 'quizzes.user_id', '=', 'users.id')
                ->get();
        } else if ($user) {
            // Normal user can only see their own quizzes
            $quizzes = Quiz::select('quizzes.id', 'quizzes.title', 'quizzes.description', 'users.name as author', 'topic_id')
                ->join('users', 'quizzes.user_id', '=', 'users.id')
                ->where('quizzes.user_id', $user->id)
                ->get();
        } else {
            // No user logged in, so no quizzes
            $quizzes = collect();
        }

        $topics = $topics->toArray();
        $quizzes = $quizzes->toArray();

        $data = [];
        foreach ($topics as &$topic) {
            $topic['quizzes'] = [];
            foreach ($quizzes as $quiz) {
                if ($topic['id'] == $quiz['topic_id']) {
                    $topic['quizzes'][] = $quiz;
                }
            }
        }
        return view('home', [
            'topics' => $topics,
            'quizzes' => $quizzes
        ]);
    }


    public function showAllTopics()
    {
        $topics = Topic::all();
         return $topics; // Return the topics, or you can keep it as is if you need to display them in a specific view.
    }



    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
