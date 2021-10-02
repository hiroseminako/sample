@extends('layouts.logout')

@section('content')

{!! Form::open(['url' => '/register']) !!}

<h2>新規ユーザー登録</h2>

{{ Form::label('ユーザー名') }}
{{ Form::text('username',null,['class' => 'input']) }}
@if($errors->has('username'))
{{ $errors->first('username') }}
@endif

{{ Form::label('メールアドレス') }}
{{ Form::text('mail',null,['class' => 'input']) }}
@if($errors->has('mail'))
{{ $errors->first('mail') }}
@endif

{{ Form::label('パスワード') }}
{{ Form::text('password',null,['class' => 'input']) }}
@if($errors->has('password'))
{{ $errors->first('password') }}
@endif

{{ Form::label('パスワード確認') }}
{{ Form::text('password-confirm',null,['class' => 'input']) }}
@if($errors->has('password-confirm'))
{{ $errors->first('password-confirm') }}
@endif

{{ Form::submit('登録') }}

<!-- 入力必須のエラーメッセージを表示させる -->

<p><a href="/login">ログイン画面へ戻る</a></p>

{!! Form::close() !!}


@endsection
