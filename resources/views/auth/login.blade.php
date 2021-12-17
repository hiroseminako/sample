@extends('layouts.logout')

@section('content')

<header>
  <h1><img src="images/main_logo.png"></h1>
</header>

<p class="login_only_text">Social Network Service</p>

<div id="container">
<div class="login_page">

{!! Form::open(['url' => '/login']) !!}

<p class="login_title">DAWNのSNSへようこそ</p>

{{ Form::label('MailAddress') }}
{{ Form::text('mail',null,['class' => 'input']) }}
{{ Form::label('password') }}
{{ Form::password('password',['class' => 'input']) }}

{{ Form::submit('LOGIN', ['class' => 'login_button']) }}

<p><a href="/register">新規ユーザーの方はこちら</a></p>

{!! Form::close() !!}

</div>
</div>
@endsection
