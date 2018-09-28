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

Auth::routes();

Route::get('logout', 'Auth\LoginController@logout')->name('logout');

Route::group([
    'namespace' => 'Front'
], function () {
    Route::name('front::')->group(function () {
        Route::get('/', 'HomeController@index')->name('home');

        Route::get('@{username}', 'UserController@show')->name('user.show');

        Route::get('{category}', 'CategoryController@show')->name('category.show');
        Route::get('{category}/{slug}', 'DiscussionController@show')->name('discussion.show');
        Route::post('{category}/{slug}/reply', 'ReplyController@store')->name('reply.store');
    });
});
