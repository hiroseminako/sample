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
    <td><a href="">フォローをはずす</a><td>
      <td><a href="">フォローする</a><td>
  <br>
</tr>
@endforeach

@endsection
