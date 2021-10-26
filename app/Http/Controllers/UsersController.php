<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\User;
use App\Follow;
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

    // ログイン画面
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

    // 検索ページ
    public function search(Request $request)
    {
        $search = $request->input('search');
        if(isset($search))
        {
            $query = User::query();
            $query->where('username', 'like', '%'.$search.'%');
            $users = $query->get();
            $follows = \DB::table('follows')
            ->where('follow', Auth::id())
            ->get()
            ->toArray();
            return view('users.search')->with(['users' => $users, 'follows' => $follows, 'search' => $search]);
        }else{
            // ユーザー一覧
            $users = User::all();
            // フォローしている人一覧
            $follows = \DB::table('follows')
            ->where('follow', Auth::id())
            ->get()
            ->toArray();
            return view('users.search')->with(['users' => $users, 'follows' => $follows]);
        }
    }

    // ログアウト
    public function logout()
    {
        // unset($_SESSION);取得したユーザーデータの削除（sessionを使う)
        Auth::logout();
        return redirect('login');
    }

}
