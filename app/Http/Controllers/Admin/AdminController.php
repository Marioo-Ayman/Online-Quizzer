<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{


    function index(){
        // $is_admin = User::select('is_admin')->get();
        //  if($is_admin=== 'admin'){
            // return view('admin.dashboard.index');   // that is working

            $user = User::get();
             return view('admin.index', ['user'=>$user]);

        }
    public function AdminLogout(Request $request)
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/login');
    }



}
