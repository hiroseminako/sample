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
  <td>{{ Form::text('mail', $user->mail, ['class' => 'profile_mail']) }}</td>
</tr>
<br>
<tr>
  <td>Password</td>
  <td>{{ Form::text('password', $user->password, ['class' => 'profile_pass', 'disabled']) }}</td>
</tr>
<br>
<tr>
  <td>new Password</td>
  <td>{{ Form::text('new_password', $user->password, ['class' => 'profile_newpass']) }}</td>
</tr>
<br>
<tr>
  <td>Bio</td>
  <td>{{ Form::text('bio', null, ['class' => 'profile_bio']) }}</td>
</tr>
<br>
<tr>
  <td>Icon Image</td>
  <td>{{ Form::file('image', ['class' => 'profile_icon']) }}</td>
</tr>
<br>
{{ Form::hidden('id', $user->id) }}
{{ Form::submit('更新', ['name' => 'update', 'class' => 'update_button']) }}

{!! Form::close() !!}

@endsection
