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
<br>
<tr>
  <td><a href="userpage/{{ $followTweet->follower }}"><img src="images/{{ $followTweet->images }}" height="55px" width="55px" class="profile_icon"></a></td>
  <td>{{ $followTweet->username }}</td>
  <td>{{ $followTweet->posts }}</td>
  <td>{{ $followTweet->created_at }}</td>
</tr>
@endforeach

@endsection
