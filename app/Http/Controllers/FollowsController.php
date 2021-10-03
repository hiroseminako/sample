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
        $is_following = $login_user->isFollowing($user->id);
        $is_followed = $login_user->isFollowed($user->id);
        $follow_count = $follow->getFollow($user->id);
        $follower_count = $follow->getFollower($user->id);

            return view('/top',[
            'user' => $user,
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
