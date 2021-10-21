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
  @foreach($follows as $follow)
    @if( $follow->id === $user->id)
    <td><a href="">フォローをはずす</a><td>
      @else
      <td><a href="">フォローする</a><td>
    @endif
  @endforeach
  <br>
</tr>
@endforeach

@endsection
