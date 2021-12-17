@extends('layouts.logout')

@section('content')

<header class="added_header">
  <h1><img src="images/main_logo.png"></h1>
</header>

<div id="container">
  <div class="login_page added_page">
    <div id="clear">
      <p>{{ session('data') }}さん、</p>
      <p>ようこそ！DAWNSNSへ！</p>
      <div class="added_text">
        <p>ユーザー登録が完了しました。</p>
        <p>さっそく、ログインをしてみましょう</p>
      </div>
      <p class="btn"><a href="/login">ログイン画面へ</a></p>
    </div>
  </div>
</div>

@endsection
