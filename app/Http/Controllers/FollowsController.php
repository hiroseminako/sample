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
    public function show(User $login_user, Follow $follow)
    {
        $login_user = auth()->user();
        $is_following = $login_user->isFollowing($login_user->id);
        $is_followed = $login_user->isFollowed($login_user->id);
        $follow_count = $follow->getFollow($login_user->id);
        $follower_count = $follow->getFollower($login_user->id);

        return view('users.show',[
            'login_user' => $login_user,
            'is_following' => $is_following,
            'is_followed' => $is_followed,
            'follow_count' => $follow_count,
            'follower_count' => $follower_count
        ]);
    }

    public function followList(){
        return view('follows.followList');
    }
    public function followerList(){
        return view('follows.followerList');
    }
}
