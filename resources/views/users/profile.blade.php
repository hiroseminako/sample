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
  <td>{{ Form::text('pass1', $user->password, ['class' => 'profile_pass1', 'disabled']) }}</td>
</tr>
<br>
<tr>
  <td>new Password</td>
  <td>{{ Form::text('pass2', $user->password, ['class' => 'profile_pass2']) }}</td>
</tr>
<br>
<tr>
  <td>Bio</td>
  <td>{{ Form::text('bio', null, ['class' => 'profile_bio']) }}</td>
</tr>
<br>
<tr>
  <td>Icon Image</td>
  <td>{{ Form::text('icon', null, ['class' => 'profile_icon']) }}</td>
</tr>
<br>
{{ Form::hidden('id', $user->id) }}
{{ Form::submit('更新', ['class' => 'update_button']) }}

{!! Form::close() !!}

@endsection
