<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller, Session;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Auth;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/index';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        // ログイン認証（一度ログインしたらログインページにアクセスすると、ログイン後のトップページに飛ぶ）
        $this->middleware('guest')->except('logout');
    }

    public function login(Request $request){
        // HTTPがPOSTのデータだった場合、trueを返す
        if($request->isMethod('post')){

            // mail, passwordのみ引っ張ってくる
            $data=$request->only('mail','password');
            // ログインが成功したら、トップページへ
            //↓ログイン条件は公開時には消すこと
            // Auth::attempt()→認証処理をする。メールアドレスやパスワードをkey, valueの形で渡す
            if(Auth::attempt($data)){
                // return redirect('/top');
                return redirect('/index');
                // return redirect('posts.index');
            }
        }
        return view("auth.login");
    }

//    public function loginName($id)
//     {
//         $name = DB::table('users')
//         ->where('id', $id)
//         ->first();
//         return view('login')->with('name',$name);
//     }

    // protected function redirectTo() {
    //     $username = Auth::username();
    //     Session::put([‘username’ => $username->username]);

    //     return ‘/home’;
    // }
}
