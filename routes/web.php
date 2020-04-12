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

//ユーザ登録
Route::get('signup', 'Auth\RegisterController@showRegistrationForm')->name('signup.get');
Route::post('signup', 'Auth\RegisterController@register')->name('signup.post');

//ログイン認証
Route::get('login', 'Auth\LoginController@showLoginForm')->name('login');
Route::post('login', 'Auth\LoginController@login')->name('login.post');
Route::get('logout', 'Auth\LoginController@logout')->name('logout.get');

//トップページ
Route::get('/', 'UsersController@index')->name('toppage');

//ユーザー詳細(お気に入り一覧を表示)
//RESTfulルーティング基本形 - Route::resource('テーブル名','...Controller');
//['only' => ['show']] showアクションへの絞り込み
// GET URI:users/{id} Name:users.show Action:UsersController@show 
Route::resource('users', 'UsersController', ['only' => ['show']]);

//作品詳細
// Route::get('works/{id}', 'WorksController@show')->name('works.show');

//ログイン「している」状態でルーティングが可能
Route::group(['middleware' => ['auth']], function () 
{
    //ユーザー詳細(投稿一覧)
    Route::group(['prefix' => 'users/{id}'], function () {
        Route::get('submit', 'UsersController@submit_index')->name('users.submit_index');
    });
    
    //お気に入りへ追加ボタン、お気に入りから外すボタン
    Route::group(['prefix' => 'works/{id}'], function () {
        Route::post('favorite', 'FavoritesController@store')->name('favorites.favorite');
        Route::delete('unfavorite', 'FavoritesController@destroy')->name('favorites.unfavorite');
    });
    
    //作品投稿ページ
    Route::resource('works', 'WorksController', ['only' => ['create' ,'store']]);
});

// // ※後で実装する
// //ジャンルでの作品の絞り込み一覧表示
// Route::get('genres/{id}/index', 'WorksController@by_genre_index')->name('works.by_genre_index');

// // ※後で実装する
// //年代での作品の絞り込み一覧表示
// Route::get('release_age/{year}/index', 'WorksController@by_release_age_index')->name('works.by_release_age_index');
