<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
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
            'new_password' => 'min:8|confirmed',
            'bio' => 'max:200'
            // 'image' => ファイルサイズの指定とか？
        ],[
            'username.min' => 'ユーザー名は４文字以上で入力してください。',
            'username.max' => 'ユーザー名は12文字以下で入力してください。',
            'mail.email' => 'アドレス形式で入力してください。',
            'mail.min' => 'メールアドレスは４文字以上で入力してください。',
            'new_password.min' => 'パスワードは8文字以上で入力してください。',
            'mail.max' => 'メールアドレスは100文字以下で入力してください。',
            'bio.max' => '自己紹介文は200文字以下で入力して下さい。'
        ]);
    }

    // プロフィール更新
    public function update(Request $request)
    {
        $username = $request->input('username');
        $mail = $request->input('mail');
        $newPassword = $request->input('new_password');
        $bio = $request->input('bio');
        $image = $request->files('image');

        if(isset($newPassword))
        {
            $data = $request->input();
            $validator = $this->validator($data);
            if($validator->fails())
            {
                return redirect('/profile')
                ->withErrors($validator)
                ->withInput();
            }elseif(isset($newPassword))
            {

            }
        }
    }

    // protected function create(array $data)
    // {
    //     return User::create([
    //         'username' => $data['username'],
    //         'mail' => $data['mail'],
    //         'password' => bcrypt($data['password']),
    //         'password-confirm' => bcrypt($data['password-confirm'])
    //     ]);
    // }

    // // 登録されたユーザー情報、エラーメッセージを取得し、addedに送る
    // public function register(Request $request){
    //     if($request->isMethod('post')){
    //         // テーブルデータの取得
    //         $data = $request->input();
    //         //エラーメッセージの取得（バリデーションの適用）
    //         $val = $this->validator($data);
    //         // エラーの時の処理
    //         if($val->fails()){
    //             // エラーメッセージの送信(セッション)
    //             return redirect('register')->withErrors($val)->withInput();
    //         }
    //         //データの取得
    //         $this->create($data);
    //         //データの送信
    //         return redirect('added')->with('data', $data['username']);
    //     }
    //     return view('auth.register');
    // }

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

    // ログアウト
    public function logout()
    {
        // unset($_SESSION);取得したユーザーデータの削除（sessionを使う)
        Auth::logout();
        return redirect('login');
    }

}
