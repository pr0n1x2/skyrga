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

//Route::get('targets/register/{date?}', 'TargetsController@register')->name('targets.register');
//Route::get('targets/register-complete/', 'TargetsController@registerComplete');
//Route::post('targets/proxy', 'TargetsController@checkProxy')->name('targets.proxy');
//Route::post('targets/generate', 'TargetsController@generate')->name('targets.generate');
Route::post('profile/set-reserve-email', 'ProfilesController@setReserveEmail');
//Route::post('targets/remove', 'TargetsController@remove');

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
    Route::get('mail-accounts/get-reserve-emails', 'MailAccountsController@getReserveEmails');
    Route::get('mail-accounts/{id}', 'MailAccountsController@show');
    Route::get('targets/register/{id}/{date?}', 'TargetsController@register')->name('targets.register');
    Route::get('targets/{date?}', 'TargetsController@index')->name('targets.index');
    Route::get('targets/martix', 'TargetsController@martix');
    Route::get('projects/download/{id}', 'ProjectsController@download')->name('projects.download');
    Route::get('hrefs/successful', 'HrefsController@successful')->name('hrefs.successful');
    Route::get('hrefs/failed', 'HrefsController@failed')->name('hrefs.failed');
    Route::get('hrefs/{id?}', 'HrefsController@index')->where('id', '[0-9]+')->name('hrefs.analyze');
    Route::put('hrefs/{id}', 'HrefsController@update')->where('id', '[0-9]+')->name('hrefs.update');


    Route::resources([
        'images' => 'ImagesController',
        'videos' => 'VideosController',
        'groups' => 'GroupsController',
        'mail-accounts' => 'MailAccountsController',
        'posts' => 'PostsController',
        'profiles' => 'ProfilesController',
        'proxies' => 'ProxiesController',
        'articles' => 'ArticlesController',
        'targets' => 'TargetsController',
        'accounts' => 'AccountsController'
    ]);

//    Route::post('projects/archive', 'ProjectsController@archive')->name('projects.archive');
    Route::post('proxies/clear', 'ProxiesController@clear')->name('proxies.clear');
    Route::post('articles/confirm/{id}', 'ArticlesController@confirm')->name('articles.confirm');

    Route::post('accounts/username', 'AccountsController@setUsername');
    Route::post('accounts/password', 'AccountsController@setPassword');
    Route::post('accounts/prefix', 'AccountsController@setPrefix');
    Route::post('accounts/gender', 'AccountsController@setGender');
    Route::post('accounts/firstname', 'AccountsController@setFirstname');
    Route::post('accounts/lastname', 'AccountsController@setLastname');
    Route::post('accounts/middlename', 'AccountsController@setMiddlename');
    Route::post('accounts/city', 'AccountsController@setCity');
    Route::post('accounts/address1', 'AccountsController@setAddress1');
    Route::post('accounts/address2', 'AccountsController@setAddress2');
    Route::post('accounts/zip', 'AccountsController@setZip');
    Route::post('accounts/phone', 'AccountsController@setPhone');
    Route::post('accounts/domainword', 'AccountsController@setDomainWord');
    Route::post('accounts/state', 'AccountsController@setState');
    Route::post('accounts/email', 'AccountsController@setEmail');
});

Route::group(['middleware' => 'admin'], function () {

    Route::get('hrefs/pending', 'HrefsController@pending')->name('hrefs.pending');

    Route::resources([
        'users' => 'UsersController',
        'hrefs' => 'HrefsController',
        'projects' => 'ProjectsController'
    ]);

    Route::get('projects/create/{id}', 'ProjectsController@create')->name('projects.create');
    Route::get('targets/create/{id}', 'TargetsController@create')->name('targets.create');
});
