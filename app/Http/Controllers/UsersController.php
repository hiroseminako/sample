<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\User;
use App\Follow;
use App\Models\Post;

class UsersController extends Controller
{
    //
    public function profile(){
        $user = \DB::table('users')
        ->where('id', Auth::id())
        ->first();

        return view('users.profile',[
            'user'=>$user
        ]);
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
        $is_following = $follower->isFollowing($user);
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
        $is_following = $follower->isFollowing($user);
        if($is_following){
            $$follower->unfollow($user->id);
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
            $query->where('username', 'like', '%'.$search.'%');
            $users = $query->get();
            // $userLists = \DB::table('users')
            // ->join('follows', 'users.id', '=', 'follows.id')
            // ->select('users.username', 'users.images', 'follows.follow')
            // ->get();
            // return view('users.search')->with(['users' => $users, 'follows' => $follows, 'search' => $search]);
            return view('users.search')->with(['users' => $users, 'search' => $search]);
            // return view('users.search')->with(['search' => $search, 'userLists' => $userLists]);
        }else{
            // ユーザー一覧
            $users = User::all();
            // フォローしている人一覧（フォローしている：フォローをはずす、フォローしていない：フォローする、と表示させる）
            $follows = Follow::all();
            $param = [
            'users' => $users,
            'follows' => $follows
        ];
            return view('users.search', $param);
            // $userLists = \DB::table('users')
            // ->join('follows', 'users.id', '=', 'follows.id')
            // ->select('users.username', 'users.images', 'follows.follow')
            // ->get();
            // return view('users.search', ['userLists' => $userLists]);
        }
    }

    // // 検索画面の表示
    // public function search(Request $request){
    //     // ユーザー一覧
    //     $users = User::all();
    //     // $users = User::paginate(20);
    //     // フォローしている人一覧
    //     $follows = Follow::all();
    //     $param = [
    //         'users' => $users,
    //         'follows' => $follows
    //     ];
    //     return view('users.search', $param);
    // }

    // // 検索結果
    // public function searchResult(Request $request){
    //     $search = $request->input('search');
    //     $query = User::query();
    //     if(!empty($search))
    //     {
    //         $query->where('username','like','%'.$search.'%');
    //     }
    //     $users = $query->get();
    //     $follows = $query->get();
    //     return view('users.search')->with(['users' => $users, 'follows' => $follows, 'search' => $search]);
    // }

    // 参考
//     if(isset($search)){
//   $sql = "select * from users where username like :search order by id desc";
//   $stmt = $pdo->prepare($sql);
//   $stmt->bindValue(':search', "%" .htmlspecialchars($search). "%", PDO::PARAM_INT);
//   }else{
//     $sql = "select * from users order by id asc";
//     $stmt = $pdo-> prepare($sql);
//   }
//   $stmt->execute();
//   $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

    // ログアウト
    public function logout()
    {
        // unset($_SESSION);取得したユーザーデータの削除（sessionを使う)
        Auth::logout();
        return redirect('login');
    }

}
