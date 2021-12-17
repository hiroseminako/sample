<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8" />
    <!--IEブラウザ対策-->
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="description" content="ページの内容を表す文章" />
    <title></title>
    <link href="https://use.fontawesome.com/releases/v5.6.1/css/all.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/reset.css') }}">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <!--スマホ,タブレット対応-->
    <meta name="viewport" content="width=device-width,initial-scale=1" />
    <!--サイトのアイコン指定-->
    <link rel="icon" href="画像URL" sizes="16x16" type="image/png" />
    <link rel="icon" href="画像URL" sizes="32x32" type="image/png" />
    <link rel="icon" href="画像URL" sizes="48x48" type="image/png" />
    <link rel="icon" href="画像URL" sizes="62x62" type="image/png" />
    <!--iphoneのアプリアイコン指定-->
    <link rel="apple-touch-icon-precomposed" href="画像のURL" />
    <!--OGPタグ/twitterカード-->
    <!-- jQuery -->
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.min.js"></script>
    <script src="js/script.js"></script>
</head>
<body>
    <header>
        <div id = "head">
            <h1 class="logo"><a href="/index"><img src="{{ asset('images/main_logo.png') }}"></a></h1>
            <div class="menu">
                <p>{{ Auth::user() -> username }}さん</p>
                <span class="arrow"></span>
                <img src="{{ asset('images/'. Auth::user()->images) }}" height="55px" width="55px" class="profile_icon">
            </div>
        </div>
    </header>
    <ul id="links">
        <li><a href="/index">ホーム</a></li>
        <li><a href="/profile">プロフィール編集</a></li>
        <li><a href="{{ route('/logout') }}">ログアウト</a></li>
    </ul>
    <div id="row">
        <div id="container">
            @yield('content')
        </div >
        <div id="side-bar">
            <div id="confirm">
                <p class="side_username">{{ Auth::user() -> username }}さんの</p>
                <div class="side_follow">
                    <p>フォロー数</p>
                    <p>{{ $follow_count }}名</p>
                </div>
                <p class="btn"><a href="/follows.followList">フォローリスト</a></p>
                <div class="side_follower">
                    <p>フォロワー数</p>
                    <p>{{ $follower_count }}名</p>
                </div>
                <p class="btn"><a href="/follows.followerList">フォロワーリスト</a></p>
            </div>
            <p class="btn side_search"><a href="/users.search" class="side_search_btn">ユーザー検索</a></p>
        </div>
    </div>
    <footer>
    </footer>
    <script src="JavaScriptファイルのURL"></script>
    <script src="JavaScriptファイルのURL"></script>
</body>
</html>
