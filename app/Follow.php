<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Follow extends Model
{
    // フォロー数、フォロワー数のカウント
    protected $fillable = [
        'follow', 'follower'
    ];

    public function getFollowCount($user_id)
    {
        return $this->where('follow', '<>', $user_id)->count();
    }

    public function getFollowerCount($user_id)
    {
        return $this->where('follower', '<>', $user_id)->count();
    }
}
