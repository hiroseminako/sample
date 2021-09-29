@extends('layouts.logout')

@section('content')

<div class="login_page">

{!! Form::open(['url' => '/login']) !!}

<p class="login_title">DAWNSNSへようこそ</p>

{{ Form::label('MailAddress') }}
{{ Form::text('mail',null,['class' => 'input']) }}
{{ Form::label('password') }}
{{ Form::password('password',['class' => 'input']) }}
<br>
{{ Form::submit('LOGIN') }}

<p><a href="/register">新規ユーザーの方はこちら</a></p>

{!! Form::close() !!}

</div>

@endsection
