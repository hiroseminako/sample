<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use \App\Post;

class PostsController extends Controller
{
    // timeline表示（Top page）
    public function index()
    {
        return view('posts.index');
    }

    // postsテーブルにつぶやきを登録
    public function create(Request $request)
    {
        $user_id = Auth::id();
        $tweet = $request->tweet;
        \DB::table('posts')->insert([
            'user_id' => $user_id,
            'posts' => $tweet,
            'created_at' => now(),
            'updated_at' => now()
        ]);
        return redirect('/index');
    }

    // つぶやきをブラウザに表示
    public function timeLine()
    {
        $comments = \DB::table('posts')
        ->join('users', 'posts.user_id', '=', 'users.id')
        ->select('users.username', 'posts.posts', 'users.images', 'posts.created_at')
        ->orderBy('posts.created_at', 'desc')
        ->get();
        return view('posts.index', ['comments'=>$comments]);
    }

}
