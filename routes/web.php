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

Route::get('targets/register/{date?}', 'TargetsController@register');
Route::get('mail-accounts/{id}', 'MailAccountsController@show');
Route::post('targets/proxy', 'TargetsController@checkProxy')->name('targets.proxy');
Route::post('profile/set-reserve-email', 'ProfilesController@setReserveEmail');
Route::post('mail-accounts/get-reserve-emails', 'MailAccountsController@getReserveEmails');
Route::post('accounts/set-new-password', 'AccountsController@setPassword');
Route::post('targets/remove', 'TargetsController@remove');

Route::group(['middleware' => 'guest'], function () {
    Auth::routes();
});

Route::group(['middleware' => 'auth'], function () {
    Route::get('/', function () {
        return redirect('home');
    });

    Route::get('home', 'HomeController@index')->name('home');
    Route::get('logout', 'Auth\LoginController@logout');
    Route::get('profile', 'UsersController@profile');
    Route::get('change-password', 'UsersController@password');
    Route::post('cookie', 'HomeController@cookie');
    Route::post('profile/update', 'UsersController@updateProfile')->name('profile.update');
    Route::post('profile/password', 'UsersController@updatePassword')->name('profile.password');
});

Route::group(['middleware' => 'author'], function () {
    Route::get('articles/attached/{id}', 'ArticlesController@attached');
    Route::get('articles/download/{id}', 'ArticlesController@download');
    Route::get('articles/edited/{id}', 'ArticlesController@edited');
    Route::get('tasks/view/{id}', 'ArticlesController@authorView');
    Route::get('tasks', 'ArticlesController@authorArticles')->name('tasks.index');
    Route::post('articles/send', 'ArticlesController@send')->name('articles.send');
    Route::post('articles/revision', 'ArticlesController@revision')->name('articles.revision');
    Route::post('articles/message', 'ArticlesController@sendMessage')->name('articles.message');
});

Route::group(['middleware' => 'user'], function () {
    Route::get('projects/zip', 'ProjectsController@zip');
    Route::get('projects/download/{id}/{file}', 'ProjectsController@download');

    Route::resources([
        'images' => 'ImagesController',
        'videos' => 'VideosController',
        'groups' => 'GroupsController',
        'mail-accounts' => 'MailAccountsController',
        'posts' => 'PostsController',
        'profiles' => 'ProfilesController',
        'projects' => 'ProjectsController',
        'proxies' => 'ProxiesController',
        'articles' => 'ArticlesController',
        'targets' => 'TargetsController'
    ]);

    Route::post('projects/archive', 'ProjectsController@archive')->name('projects.archive');
    Route::post('proxies/clear', 'ProxiesController@clear')->name('proxies.clear');
    Route::post('articles/confirm/{id}', 'ArticlesController@confirm')->name('articles.confirm');
});

Route::group(['middleware' => 'admin'], function () {
    Route::resources([
        'users' => 'UsersController',
    ]);
});
