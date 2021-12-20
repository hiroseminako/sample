<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use App\User;
use App\Follow;
use App\Models\Post;

class UsersController extends Controller
{
    // プロフィール画面
    public function profile()
    {
        $user = \DB::table('users')
        ->where('id', Auth::id())
        ->first();
        return view('users.profile', ['user' => $user]);
    }

    // プロフィール内容の条件：バリデーション
    public function validator(array $data)
    {
        return Validator::make($data, [
            'username' => 'min:2|max:12',
            'mail' => 'email|min:4|max:100',
            'bio' => 'max:200'
            // 'images' => ファイルサイズの指定とか
        ],[
            'username.min' => 'ユーザー名は2文字以上で入力してください。',
            'username.max' => 'ユーザー名は12文字以下で入力してください。',
            'mail.email' => 'アドレス形式で入力してください。',
            'mail.min' => 'メールアドレスは４文字以上で入力してください。',
            'mail.max' => 'メールアドレスは100文字以下で入力してください。',
            'bio.max' => '自己紹介文は200文字以下で入力して下さい。'
        ]);
    }

    // プロフィール更新
    public function update(Request $request)
    {
        $username = $request->input('username');
        $mail = $request->input('mail');
        $new_password = $request->input('new_password');
        $bio = $request->input('bio');
        $images = $request->file('images');

        $data = $request->input();
        $validator = $this->validator($data);

        // バリデーション
        if($validator->fails())
        {
            return redirect('/profile')
            ->withErrors($validator)
            ->withInput();
        }

        // NewパスワードとProfile画像のアップデートとそれ以外に分ける
        // NewパスワードとProfile画像のアップデート
        else{
            if(isset($new_password) && isset($images))
            {
            $filename = $images->getClientOriginalName();
            $images->storeAs('images', $filename, 'icon');
            \DB::table('users')
            ->where('id', Auth::id())
            ->update([
                'username' => $username,
                'mail' => $mail,
                'password' => bcrypt($new_password),
                'bio' => $bio,
                'images' => $filename,
                'updated_at' => now()
            ]);
            }

            // Profile画像のみアップデート
            elseif(isset($new_password) && empty($images))
            {
                \DB::table('users')
                ->where('id', Auth::id())
                ->update([
                    'username' => $username,
                    'mail' => $mail,
                    'password' => bcrypt($new_password),
                    'bio' => $bio,
                    'updated_at' => now()
                ]);
            }

            // Newパスワードのみアップデート
            elseif(isset($images) && empty($new_password))
            {
                $filename = $images->getClientOriginalName();
                // icon: config>filesystem.phpで管理する
                $images->storeAs('images', $filename, 'icon');
                \DB::table('users')
                ->where('id', Auth::id())
                ->update([
                    'username' => $username,
                    'mail' => $mail,
                    'bio' => $bio,
                    'images' => $filename,
                    'updated_at' => now()
                ]);
            }

            // 上記以外（ユーザー名、メールアドレス、自己紹介文）
            else{
                \DB::table('users')
                ->where('id', Auth::id())
                ->update([
                    'username' => $username,
                    'mail' => $mail,
                    'bio' => $bio,
                    'updated_at' => now()
                ]);
            }

            return redirect('/profile');

        }
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
        $is_following = $follower->isFollowing($user->id);
        // フォローしていなければフォローする
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
        $is_following = $follower->isFollowing($user->id);
        // フォローしていればフォロー解除
        if($is_following){
            $follower->unfollow($user->id);
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
            $query->where('username', 'like', '%'.$search.'%')
            ->where('id', '<>', Auth::id());
            $users = $query->get();
            $follows = \DB::table('follows')
            ->where('follow', Auth::id())
            ->get()
            ->toArray();
            return view('users.search')->with(['users' => $users, 'follows' => $follows, 'search' => $search]);
        }else{
            // ユーザー一覧
            $users = User::all()
            ->where('id', '<>', Auth::id());
            // フォローしている人一覧
            $follows = \DB::table('follows')
            ->where('follow', Auth::id())
            ->get()
            ->toArray();
            return view('users.search')->with(['users' => $users, 'follows' => $follows]);
        }
    }

    // 個別ユーザーページ
        public function userPage($id)
    {
        $user = \DB::table('users')
        ->where('id', $id)
        ->select('id', 'images', 'username', 'bio')
        ->first();

        $follows = \DB::table('follows')
        ->where('follow', Auth::id())
        ->get()
        ->toArray();

        $userTweets = \DB::table('posts')
        ->join('users', 'users.id', '=', 'posts.user_id')
        ->where('user_id', $id)
        ->select('posts.posts', 'posts.created_at', 'users.username', 'users.images', 'users.id')
        ->orderBy('posts.created_at', 'desc')
        ->get();

        return view('users.userpage')->with(['user' => $user, 'follows' => $follows, 'userTweets' => $userTweets]);
    }

    // ログアウト
    public function logout()
    {
        session()->forget('key');
        Auth::logout();
        return redirect('login');
    }

}
