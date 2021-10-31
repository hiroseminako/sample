@extends('layouts.login')

@section('content')

@foreach($followers as $follower)
<tr>
  <td><a href="profile/{{ $follower->follow }}"><img src="images/{{ $follower->images }}"></a></td>
</tr>
@endforeach

@foreach($followerTweets as $followerTweet)
<br>
<tr>
  <td><a href="profile/{{ $followerTweet->follow }}"><img src="images/{{ $followerTweet->images }}"></a></td>
  <td>{{ $followerTweet->username }}</td>
  <td>{{ $followerTweet->posts }}</td>
  <td>{{ $followerTweet->created_at }}</td>
</tr>
@endforeach

@endsection
