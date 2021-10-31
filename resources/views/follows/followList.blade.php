@extends('layouts.login')

@section('content')

@foreach($follows as $follow)
<tr>
  <td><a href="profile/{{ $follow->follower }}"><img src="images/{{ $follow->images }}"></a></td>
</tr>
@endforeach

@foreach($followTweets as $followTweet)
<br>
<tr>
  <td><a href="profile/{{ $followTweet->follower }}"><img src="images/{{ $followTweet->images }}"></a></td>
  <td>{{ $followTweet->username }}</td>
  <td>{{ $followTweet->posts }}</td>
  <td>{{ $followTweet->created_at }}</td>
</tr>
@endforeach

@endsection
