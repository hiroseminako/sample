@extends('layouts.login')

@section('content')

<tr>
  <td><a href="/userpage/{{ $user->id }}"><img src="{{ asset('images/'.$user->images) }}" height="55px" width="55px" class="profile_icon"></a></td>
</tr>

<tr>
  <td>Name</td>
  <td>{{ $user->username }}</td>
</tr>
<br>
<tr>
  <td>Bio</td>
  <td>{{ $user->bio }}</td>
</tr>

<tr>
  @if(in_array($user->id, array_column($follows, 'follower')))
    <td>
      <a href="/users/{{ $user->id }}/unfollow">フォローをはずす</a>
    </td>
    <br>
      @else
      <td>
        <a href="/users/{{ $user->id }}/follow">フォローする</a>
      </td>
    <br>
  @endif
</tr>

@foreach($userTweets as $userTweet)
<br>
<tr>
  <td><a href="/userpage/{{ $userTweet->id }}"><img src="{{ asset('images/' .$userTweet->images) }}" height="55px" width="55px" class="profile_icon"></a></td>
  <td>{{ $userTweet->username }}</td>
  <td>{{ $userTweet->posts }}</td>
  <td>{{ $userTweet->created_at }}</td>
</tr>
@endforeach

@endsection
