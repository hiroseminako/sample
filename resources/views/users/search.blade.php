@extends('layouts.login')

@section('content')

{!! Form::open(['url' => '/users.search']) !!}

{{ Form::text('search', null, ['class' => 'search', 'placeholder' => 'ユーザー名']) }}
{{ Form::submit('') }}

{!! Form::close() !!}

@foreach($users as $user)
<tr>
  <td><img src="images/{{ $user->images }}"></td>
  <td>{{ $user->username }}</td>
  @if(in_array($user->id, array_column($follows, 'follows')))
    <td>
      {!! Form::open(['action' => 'unfollow', 'method' => 'post']) !!}
      {{ Form::submit('フォローをはずす') }}
      {!! Form::close() !!}
        <a href="">フォローをはずす</a>
    </td>
      @else
      <td>
        {!! Form::open(['action' => 'follow', 'method' => 'post']) !!}
        {{ Form::submit('フォローする') }}
        {!! Form::close() !!}
        <a href="">フォローする</a>
      </td>
  <br>
  @endif
</tr>
@endforeach

@endsection
