<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\User;
use App\Post;
use App\Follow;

class FollowsController extends Controller
{
    //フォロー数、フォロワー数の取得
    public function show(User $user, Follow $follow)
    {
        $login_user = auth()->user();
        $is_following = $login_user->isFollowing($login_user->id);
        $is_followed = $login_user->isFollowed($login_user->id);
        $follow_count = $follow->getFollowCount($login_user->id);
        $follower_count = $follow->getFollowerCount($login_user->id);

            return view('posts.index',[
            'user' => $user,
            'is_following' => $is_following,
            'is_followed' => $is_followed,
            'follow_count' => $follow_count,
            'follower_count' => $follower_count
        ]);
    }

    // フォロー一覧
    public function followList(){
        $follows = \DB::table('follows')
        ->join('users', 'follows.follower', '=', 'users.id')
        ->where('follows.follow', '=', Auth::id())
        ->select('users.images', 'follows.follower')
        ->get();
        $followTweets = \DB::table('users')
        ->join('follows', 'follows.follower', '=', 'users.id')
        ->join('posts', 'posts.user_id', '=', 'users.id')
        ->where('follows.follow', '=', Auth::id())
        ->select('users.username', 'users.images', 'posts.posts', 'posts.created_at', 'posts.updated_at', 'follows.follower')
        ->orderBy('posts.created_at', 'desc')
        ->get();
        return view('follows.followList')->with(['follows' => $follows, 'followTweets' => $followTweets]);
        return view('/profile')->with(['follows' => $follows, 'followTweets' => $followTweets]);
    }

    // フォロワー一覧
    public function followerList(){
        $followers = \DB::table('follows')
        ->join('users', 'follows.follow', '=', 'users.id')
        ->where('follows.follower', '=', Auth::id())
        ->select('users.images', 'follows.follow')
        ->get();
        $followerTweets = \DB::table('users')
        ->join('follows', 'follows.follow', '=', 'users.id')
        ->join('posts', 'posts.user_id', '=', 'users.id')
        ->where('follows.follower', '=', Auth::id())
        ->select('users.username', 'users.images', 'posts.posts', 'posts.created_at', 'posts.updated_at', 'follows.follow')
        ->orderBy('posts.created_at', 'desc')
        ->get();
        return view('follows.followerList')->with(['followers' => $followers, 'followerTweets' => $followerTweets]);
        return view('follows.followerList')->with(['followers' => $followers, 'followerTweets' => $followerTweets]);
    }
}
