<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use \App\Post;

class PostsController extends Controller
{
    // timeline表示（Top page）
    public function index()
    {
        return view('posts.index');
    }

    // つぶやきの文字数制限：バリデーション
    public function validator(array $data)
    {
        return Validator::make($data, [
            'tweet' => 'min:1|max:200',
            'tweet_update' => 'min:1|max:200'
        ],[
            'tweet.min' => '入力フィールドが空欄になっています。１文字以上入力してください。',
            'tweet.max' => 'つぶやきは200文字までです。',
            'tweet_update.min' => '入力フィールドが空欄になっています。１文字以上入力してください。',
            'tweet_update.max' => 'つぶやきは200文字までです。'
        ]);
    }

    // postsテーブルにつぶやきを登録
    public function create(Request $request)
    {
        $data = $request->input();
        $validator = $this->validator($data);

        if($validator->fails())
        {
            return redirect('/index')
            ->withErrors($validator)
            ->withInput();
        }

        else{
            $user_id = Auth::id();
            $tweet = $request->input('tweet');
            \DB::table('posts')
            ->insert([
                'user_id' => $user_id,
                'posts' => $tweet,
                'created_at' => now()
            ]);
            return redirect('/index');
        }
    }

    // つぶやきをブラウザに表示
    public function timeLine()
    {
        $comments = \DB::table('posts')
        ->join('users', 'posts.user_id', '=', 'users.id')
        ->select('users.username', 'posts.posts', 'users.images', 'posts.created_at', 'posts.id')
        ->orderBy('posts.created_at', 'desc')
        ->get();
        return view('posts.index', ['comments' => $comments]);
    }

    // つぶやきの更新
    public function update(Request $request)
    {
        $tweet_update = $request->input('tweet_update');
        $tweet_id = $request->input('tweet_id');

        $data = $request->input();
        $validator = $this->validator($data);

        if($validator->fails())
        {
            return redirect('/index')
            ->withErrors($validator)
            ->withInput();
        }

        else{
        \DB::table('posts')
        ->where('id', $tweet_id)
        ->update([
            'posts' => $tweet_update,
            'updated_at' => now()
        ]);
        return redirect('/index');
        }
    }

    // つぶやきの削除
    public function delete()
    {
        \DB::table('posts')
        ->delete();
        return back();
    }

}
