<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Follow;
use App\Models\Post;

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

    // フォローする
    public function follow(User $user, $id)
    {
        $user = User::find($id);
        $follower = Auth::user();
        $is_following = $follower->isFollowing($user);
        if(!$is_following){
            $follower->follow($user->id);
        }
        return back();
    }

    // フォロー解除する
    public function unfollow(User $user, $id)
    {
        $user = User::find($id);
        $follower = Auth::user();
        $is_following = $follower->isFollowing($user);
        if($is_following){
            $$follower->unfollow($user->id);
        }
        return back();
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

    // //フォロー
    // public function follow(User $user,$id)
    // {
    //     $user = User::find($id);
    //     //var_dump($user);
    //     $follower = auth()->user();
    //     //フォローしているか
    //     $is_following = $follower->isFollowing($user->id);
    //      if(!$is_following) {
    //         //フォローしていなければする
    //          $follower->follow($user->id);
    //          return back();
    //      }
    //     //return view('sample');
    // }
}
