<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'username', 'mail', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    // フォロワーの取得（リレーション）
    public function followers(){
        // 第一引数：使用するモデル（User.php）
        // 第二引数：使用するテーブル名（followsテーブル）
        // 第三引数：リレーションを定義しているモデルの外部キー名（follower（フォロワーのid））
        // 第四引数：結合するモデルの外部キー名
        return $this->belongsToMany(self::class, 'follows', 'follower', 'follow');
    }

    // フォローしているユーザーの取得（リレーション）
    public function follows(){
        // 第一引数：使用するモデル（User.php）
        // 第二引数：使用するテーブル名（followsテーブル）
        // 第三引数：リレーションを定義しているモデルの外部キー名（follow（フォローしているユーザーのid））
        // 第四引数：結合するモデルの外部キー名
        return $this->belongsToMany(self::class, 'follows', 'follow', 'follower');
    }

    //フォローする
    public function follow(Int $user_id)
    {
        return $this->follows()->attach($user_id);
    }

    //フォロー解除する
    public function unfollow(Int $user_id)
    {
        return $this->follows()->detach($user_id);
    }

    // フォローしているか
    public function isFollowing(Int $user_id)
    {
        // booleanで真偽の判定、existsメソッドでfollowerが存在しているか確認
        return (boolean) $this->follows()->where('follower', $user_id)->exists();
    }

    // フォローされているか
    public function isFollowed(Int $user_id)
    {
        // booleanで真偽の判定、existsメソッドでfollowが存在しているか確認
        return (boolean) $this->followers()->where('follow', $user_id)->exists();
    }

    // １ページあたりの表示数
    public function getAllUsers(Int $user_id)
    {
        return $this->follows()->where('follower', $user_id)->paginate(20);
    }

    // 検索一覧
    public function users() {
        return $this->hasMany('App\User');
    }

}
