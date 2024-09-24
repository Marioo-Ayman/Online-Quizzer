<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Illuminate\Routing\Controllers\HasMiddleware;

class AdminDashboardController extends Controller
// implements HasMiddleware
{
    // public static function middleware(){
    //         return[
    //             'role'
    //         ];
    // }

    function index(){
        // $is_admin = User::select('is_admin')->get();
        //  if($is_admin=== 'admin'){
            return view('admin.dashboard.index');

        }

}
