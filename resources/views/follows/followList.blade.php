@extends('layouts.login')

@section('content')

<div class="follow_title_wrap">
  <p class="follow_title">Follow List</p>

  <div class="follow_icons_wrap">
    @foreach($follows as $follow)
    <tr>
      <td><a href="userpage/{{ $follow->follower }}"><img src="images/{{ $follow->images }}" height="55px" width="55px" class="profile_icon follow_icon"></a></td>
    </tr>
    @endforeach
  </div>

</div>

@foreach($followTweets as $followTweet)
<div class="all_tweets">
  <p class="tweet_image"><a href="userpage/{{ $followTweet->follower }}"><img src="images/{{ $followTweet->images }}" height="55px" width="55px" class="profile_icon"></a></p>
  <p class="tweet_username">{{ $followTweet->username }}</p>
  <p class="tweet_date">{{ $followTweet->created_at }}</p>
  <p class="tweet_post">{{ $followTweet->posts }}</p>
</div>
@endforeach

@endsection
