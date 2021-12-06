@extends('layouts.login')

@section('content')

{!! Form::open(['url' => '/users.search']) !!}

{{ Form::text('search', null, ['class' => 'search', 'placeholder' => 'ユーザー名']) }}
{{ Form::submit('') }}

{!! Form::close() !!}

@foreach($users as $user)
<tr>
  <td><img src="images/{{ $user->images }}" height="55px" width="55px" class="profile_icon"></td>
  <td>{{ $user->username }}</td>
  @if(in_array($user->id, array_column($follows, 'follower')))
    <td>
      <a href="users/{{ $user->id }}/unfollow">フォローをはずす</a>
    </td>
    <br>
      @else
      <td>
        <a href="users/{{ $user->id }}/follow">フォローする</a>
      </td>
    <br>
  @endif
</tr>
@endforeach

@endsection
