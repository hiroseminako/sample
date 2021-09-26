<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UsersController extends Controller
{
    //
    public function profile(){
        $user = \DB::table('users')
        ->where('id', Auth::id())
        ->first();

        return view('users.profile',[
            'user'=>$user
        ]);
    }

    public function login()
    {
        $auth = Auth::user();
        return view('users.login',['auth' => $auth]);
    }

    public function search(){
        return view('users.search');
    }

    public function logout()
    {
        // unset($_SESSION);
        Auth::logout();
        return redirect('login');
    }
}
