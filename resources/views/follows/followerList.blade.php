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
<br>
<tr>
  <td><a href="userpage/{{ $followerTweet->follow }}"><img src="images/{{ $followerTweet->images }}" height="55px" width="55px" class="profile_icon"></a></td>
  <td>{{ $followerTweet->username }}</td>
  <td>{{ $followerTweet->posts }}</td>
  <td>{{ $followerTweet->created_at }}</td>
</tr>
@endforeach

@endsection
