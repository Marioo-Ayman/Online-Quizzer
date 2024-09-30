<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;

class UserController extends Controller
{
    // public function login(){

    //     return view('user.index');
    // }

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
            return view('user.userDashboard');
        };
        throw ValidationException::withMessages([
            'email'=>['credentail false']
        ]);

        // dd($user);
    //    Auth::login($user);

    //    return view('user.userDashboard');
    }

    public function logout(Request $request){
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');

        // Auth::logout();
        // return redirect('/user/show');
    }
}
