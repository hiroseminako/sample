<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\View;
use \App\Follow;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function __construct()
    {
        $this->middleware(function ($request, $next)
        {
            //ログインユーザー名
            $username = Auth::user();
            //フォロワーのカウント
            $follower_count = Follow::where('follow', '=', Auth::id())->count();
            //フォローのカウント
            $follow_count = Follow::where('follower', '=', Auth::id())->count();
            View::share('username', $username['username']);
            View::share('follower_count', $follower_count);
            View::share('follow_count', $follow_count);

            return $next($request);
        });
    }
}
