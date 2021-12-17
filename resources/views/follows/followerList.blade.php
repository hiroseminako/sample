@extends('layouts.login')

@section('content')

<div class="follow_title_wrap">
  <p class="follow_title">Follower List</p>

  <div class="follow_icons_wrap">
    @foreach($followers as $follower)
    <tr>
      <td><a href="userpage/{{ $follower->follow }}"><img src="images/{{ $follower->images }}" height="55px" width="55px" class="profile_icon follow_icon"></a></td>
    </tr>
    @endforeach
  </div>

</div>

@foreach($followerTweets as $followerTweet)
<div class="all_tweets">
  <p class="tweet_image"><a href="userpage/{{ $followerTweet->follow }}"><img src="images/{{ $followerTweet->images }}" height="55px" width="55px" class="profile_icon"></a></p>
  <p class="tweet_username">{{ $followerTweet->username }}</p>
  <p class="tweet_date">{{ $followerTweet->created_at }}</p>
  <p class="tweet_post">{{ $followerTweet->posts }}</p>
</div>
@endforeach

@endsection
