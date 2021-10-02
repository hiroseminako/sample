<?php

namespace App\Http\Controllers\Auth;

use App\User;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/login';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    // ログイン後もアクセス可
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'username' => 'required|string|min:1|max:255',
            'mail' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:4|confirmed',
            'password-confirm' => 'required|string|min:4|confirmed'
        ],[
            'username.required' => '名前を入力してください',
            'mail.required' => 'メールアドレスを入力してください',
            'mail.email' => 'アドレス形式で入力してください',
            'password.required' => 'パスワードを入力してください',
            'password.min:4' => '4パスワードは文字以上で入力してください',
            'password-confirm.min:4' => 'パスワードは4文字以上で入力してください'
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    protected function create(array $data)
    {
        return User::create([
            'username' => $data['username'],
            'mail' => $data['mail'],
            'password' => bcrypt($data['password']),
            'password-confirm' => bcrypt($data['password-confirm'])
        ]);
    }

    // 登録されたユーザー情報、エラーメッセージを取得し、addedに送る
    public function register(Request $request){
        if($request->isMethod('post')){
            $data = $request->input();
            //エラーメッセージの取得
            $val = $this->validator($data);
            if($val->fails()){
                //エラーメッセージの送信
                return redirect('register')->withErrors($val)->withInput();
            }
            //データの取得
            $this->create($data);
            //データの送信
            return redirect('added')->with('data', $data['username']);
        }
        return view('auth.register');
    }

    // addedに取得した名前、エラーメッセージを表示させる
    public function added(Request $request){
        return view('auth.added');
    }

}
