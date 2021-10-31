@extends('layouts.login')

@section('content')

<p><img src="images/{{ $user->images }}"></p>

{!! Form::open(['url' => '/profile']) !!}

<tr>
  <td>UserName</td>
  <td>{{ Form::text('username', $user->username, ['class' => 'profile_name']) }}</td>
</tr>
<br>
<tr>
  <td>MailAddress</td>
  <td>{{ Form::text('mailaddress', $user->mail, ['class' => 'profile_mail']) }}</td>
</tr>
<br>
<tr>
  <td>Password</td>
  <td>{{ $user->password }}</td>
</tr>
<br>
<tr>
  <td>new Password</td>
  <td>{{ Form::text('pass2', '初期値持ってくるかつ黒丸表示', ['class' => 'profile_pass2']) }}</td>
</tr>
<br>

{!! Form::close() !!}

@endsection
