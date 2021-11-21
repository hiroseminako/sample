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


//ログアウト中のページ
Route::get('/login', 'Auth\LoginController@login');
Route::post('/login', 'Auth\LoginController@login');

Route::get('/register', 'Auth\RegisterController@register');
Route::post('/register', 'Auth\RegisterController@register');

Route::get('/added', 'Auth\RegisterController@added');
Route::post('/added', 'Auth\RegisterController@added');

Route::post('/added', 'Auth\RegisterController@added');

//ログイン中のページ
Route::get('/index','PostsController@index');
// プロフィール編集画面
Route::get('/profile','UsersController@profile');
Route::get('/search','UsersController@index');
Route::get('/profile/{id}','UsersController@update');
Route::post('/profile/{id}','UsersController@update');
Route::get('/follow-list','PostsController@index');
Route::get('/follower-list','PostsController@index');

// フォロー数、フォロワー数
Route::get('/index', 'FollowsController@show');

// フォローリスト一覧
Route::get('follows.followList', 'FollowsController@followList');
Route::get('profile/{id}', 'FollowsController@followList');
// フォロワーリスト一覧
Route::get('follows.followerList', 'FollowsController@followerList');
Route::get('profile/{id}', 'FollowsController@followerList');

// 検索ページ
Route::get('users.search', 'UsersController@search');
Route::post('users.search', 'UsersController@search');
// フォローする
Route::get('users/{id}/follow', 'UsersController@follow');
// フォローを外す
Route::get('users/{id}/unfollow', 'UsersController@unfollow');

// つぶやき表示
Route::get('/index','PostsController@timeLine');
Route::post('/index','PostsController@create');

// ログアウト
Route::get('/logout', [
    'uses' => 'UsersController@logout',
    'as' => '/logout'
]);







// Route::group(['prefix' => 'user'], function() {

//   Route::group(['middleware' => 'auth'], function(){

//   // ユーザープロファイル
//   Route::get('/profile',[
//     'uses' => 'UserController@getProfile',
//     'as' => 'user.profile'
//   ]);

//   // ログアウト
//   Route::get('/logout',[
//     'uses' => 'UserController@getLogout',
//     'as' => 'user.logout'
//   ]);

// });
