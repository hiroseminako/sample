@extends('layouts.login')

@section('content')

<div class="profile_wrap">
  <tr class="profile_image">
    <td>
      <img src="images/{{ $user->images }}" height="55px" width="55px" class="profile_icon">
    </td>
  </tr>

  <div class="profile_item">
    <p>UserName</p>
    <p>MailAddress</p>
    <p>Password</p>
    <p>new Password</p>
    <p>Bio</p>
    <p>Icon Image</p>
  </div>

  <div class="profile_form">
    {!! Form::open(['url' => '/profile', 'files' => true]) !!}

    <tr class="profile_username">
      <!-- <td>UserName</td> -->
      <td>{{ Form::text('username', $user->username, ['class' => 'profile_name']) }}</td>
      @if($errors->has('username'))
      {{ $errors->first('username') }}
      @endif
    </tr>
    <br>
    <tr>
      <!-- <td>MailAddress</td> -->
      <td>{{ Form::text('mail', $user->mail, ['class' => 'profile_mail']) }}</td>
      @if($errors->has('mail'))
      {{ $errors->first('mail') }}
      @endif
    </tr>
    <br>
    <tr>
      <!-- <td>Password</td> -->
      <td>{{ Form::input('password', 'password', 'pass1', ['class' => 'profile_pass', 'disabled']) }}</td>
    </tr>
    <br>
    <tr>
      <!-- <td>new Password</td> -->
      <td>{{ Form::password('new_password', null, ['class' => 'profile_newpass']) }}</td>
      @if($errors->has('new_password'))
      {{ $errors->first('new_password') }}
      @endif
    </tr>
    <br>
    <tr>
      <!-- <td>Bio</td> -->
      <td>{{ Form::text('bio', null, ['class' => 'profile_bio']) }}</td>
      @if($errors->has('bio'))
      {{ $errors->first('bio')}}
      @endif
    </tr>
    <br>
    <tr>
      <!-- <td>Icon Image</td> -->
      <td>{{ Form::file('images', ['class' => 'profile_images']) }}</td>
      @if($errors->has('images'))
      {{ $errors->first('images')}}
      @endif
    </tr>
    <br>
    {{ Form::hidden('id', $user->id) }}
    {{ Form::submit('更新', ['name' => 'update', 'class' => 'update_button']) }}

    {!! Form::close() !!}
  </div>
</div>

@endsection
