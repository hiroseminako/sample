@extends('layouts.logout')

@section('content')

<header class="register_header">
  <h1><img src="images/main_logo.png"></h1>
</header>

<div id="container">
  <div class="login_page register_page">
    {!! Form::open(['url' => '/register']) !!}

    <p>新規ユーザー登録</p>
    {{ Form::label('UserName') }}
    {{ Form::text('username',null,['class' => 'input']) }}
    @if($errors->has('username'))
    {{ $errors->first('username') }}
    @endif

    {{ Form::label('MailAddress') }}
    {{ Form::text('mail',null,['class' => 'input']) }}
    @if($errors->has('mail'))
    {{ $errors->first('mail') }}
    @endif

    {{ Form::label('Password') }}
    {{ Form::password('password',null,['class' => 'input']) }}
    @if($errors->has('password'))
    {{ $errors->first('password') }}
    @endif

    {{ Form::label('Password confirm') }}
    {{ Form::password('password_confirmation',null,['class' => 'input']) }}
    @if($errors->has('password-confirm'))
    {{ $errors->first('password-confirm') }}
    @endif

    {{ Form::submit('REGISTER', ['class' => 'login_button']) }}

    {!! Form::close() !!}

  <!-- 入力必須のエラーメッセージを表示させる -->
    <p><a href="/login">ログイン画面へ戻る</a></p>
  </div>
</div>



@endsection
