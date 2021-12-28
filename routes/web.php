<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});
Route::get('/home', 'HomeController@index')->name('home');

Auth::routes();


//ログアウトする画面（ログアウト中画面）
Route::get('/login', 'Auth\LoginController@login');
Route::post('/login', 'Auth\LoginController@login');

// 登録画面
Route::get('/register', 'Auth\RegisterController@register');
Route::post('/register', 'Auth\RegisterController@register');

// 登録完了後画面
Route::get('/added', 'Auth\RegisterController@added');
Route::post('/added', 'Auth\RegisterController@added');

//トップページ
Route::get('/index','PostsController@index');

// プロフィール編集画面
Route::get('/profile', 'UsersController@profile');
Route::post('/profile', 'UsersController@update');

// トップページの右側カラム
Route::get('/search','UsersController@index');
Route::get('/follow-list','PostsController@index');
Route::get('/follower-list','PostsController@index');

// トップページのフォロー数、フォロワー数
Route::get('/index', 'FollowsController@show');

// フォローリスト一覧
Route::get('follows.followList', 'FollowsController@followList');
// フォロワーリスト一覧
Route::get('follows.followerList', 'FollowsController@followerList');
// 個別ユーザーページ
Route::get('userpage/{id}', 'UsersController@userPage');

// 検索ページ
Route::get('users.search', 'UsersController@search');
Route::post('users.search', 'UsersController@search');

// フォローする
Route::get('users/{id}/follow', 'UsersController@follow');
// フォローを外す
Route::get('users/{id}/unfollow', 'UsersController@unfollow');

// トップページのつぶやき表示
Route::get('/index','PostsController@timeLine');
Route::post('/index','PostsController@create');

// つぶやき更新
Route::post('/index/{id}/edit','PostsController@update');

// つぶやき削除
Route::get('/index/{id}/delete','PostsController@delete');

// ログアウト
Route::get('/logout', [
    'uses' => 'UsersController@logout',
    'as' => '/logout'
]);
