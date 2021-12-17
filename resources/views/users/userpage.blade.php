@extends('layouts.login')

@section('content')

<div class="user_profile">
  <p><a href="/userpage/{{ $user->id }}"><img src="{{ asset('images/'.$user->images) }}" height="55px" width="55px" class="profile_icon"></a></p>

  <div class="user_profile_items">
    <p>Name</p>
    <p>Bio</p>
  </div>

  <div class="user_profile_details">
    <p>{{ $user->username }}</p>
    <p>{{ $user->bio }}</p>
  </div>

  <div class="userpage_btn">
    @if(in_array($user->id, array_column($follows, 'follower')))
      <p class="search_list_btn">
        <a href="/users/{{ $user->id }}/unfollow">フォローをはずす</a>
      </p>
      @else
      <p class="search_list_btn unfollow_btn">
        <a href="/users/{{ $user->id }}/follow">フォローする</a>
      </p>
    @endif
  </div>
</div>

@foreach($userTweets as $userTweet)
  <div class="all_tweets">
    <p class="tweet_image"><a href="/userpage/{{ $userTweet->id }}"><img src="{{ asset('images/' .$userTweet->images) }}" height="55px" width="55px" class="profile_icon"></a></p>
    <p class="tweet_username">{{ $userTweet->username }}</p>
    <p class="tweet_date">{{ $userTweet->created_at }}</p>
    <p class="tweet_post">{{ $userTweet->posts }}</p>
  </div>
@endforeach

@endsection
