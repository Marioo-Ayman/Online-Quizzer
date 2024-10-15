<?php

namespace App\Http\Controllers;

use App\Models\Question;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;

class UserController extends Controller
{

    public function store(Request $request){

        $request->validate([
            'email'=>'required|email',
            'password'=>'required',
        ]);

        $credentials = [
            'email'=>$request->email,
            'password'=>$request->password,
        ];
        if(Auth::attempt($credentials, $request->remember_me)){
            if(Auth::user()->role !=="admin")
                return view('user_profile.home');
            else
                return redirect('/admin/dashboard');
        };
        throw ValidationException::withMessages([
            'email'=>['credentail false']
        ]);

    }

    public function logout(Request $request){
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');

    }

    protected $fillable = ['question_id', 'answer_text', 'is_correct'];


    public function question()
    {
        return $this->belongsTo(Question::class);
    }
}
