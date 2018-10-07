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

        Route::get('search', 'SearchController@search')->name('search');

        Route::middleware('auth')->group(function () {
            Route::post('ajax/discussion/upvote/{encodedId}', 'UpvoteController@toggleUpvoteDiscussion')
                ->name('ajax.discussion.upvote');

            Route::get('new', 'DiscussionController@create')->name('discussion.create');
            Route::post('new', 'DiscussionController@store')->name('discussion.store');

            Route::view('me/settings', 'front.profile.settings.show')->name('profile.settings.show');
            Route::post('me/settings', 'ProfileSettingsController@update')->name('profile.settings.update');

            Route::post('{category}/{slug}/reply', 'ReplyController@store')->name('reply.store');
        });

        Route::get('p/{slug}', 'PageController@show')->name('page.show');

        Route::get('@{username}', 'ProfileController@show')->name('profile.show');

        Route::get('{category}', 'CategoryController@show')->name('category.show');
        Route::get('{category}/{slug}', 'DiscussionController@show')->name('discussion.show');
    });
});
