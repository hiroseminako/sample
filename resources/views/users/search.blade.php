@extends('layouts.login')

@section('content')

<div class="search_wrap">
  {!! Form::open(['url' => '/users.search']) !!}
  {{ Form::text('search', null, ['class' => 'search', 'placeholder' => 'ユーザー名']) }}
  {{ Form::button('<i class="fas fa-search search_font"></i>', ['class' => 'search_btn', 'type' => 'submit']) }}
  {!! Form::close() !!}
</div>

@foreach($users as $user)
<div class="search_list_wrap">
  <p class="search_list">
    <a href="/userpage/{{ $user->id }}"><img src="images/{{ $user->images }}" height="55px" width="55px" class="profile_icon"></a>
    <span class="search_list_username">{{ $user->username }}</span>
  </p>

  @if(in_array($user->id, array_column($follows, 'follower')))
    <p class="search_list_btn">
      <a href="users/{{ $user->id }}/unfollow">フォローをはずす</a>
    </p>
      @else
      <p class="search_list_btn unfollow_btn">
        <a href="users/{{ $user->id }}/follow">フォローする</a>
      </p>
  @endif
</div>
@endforeach

@endsection
