<?php

Auth::routes();

Route::get('logout', 'Auth\LoginController@logout')->name('logout');

Route::group([
    'namespace' => 'Front'
], function () {
    Route::name('front::')->group(function () {
        Route::get('/', 'HomeController@index')->name('home');

        Route::post('ajax/feedback', 'AjaxController@feedback')->name('ajax.feedback');

        Route::middleware('auth')->group(function () {
            Route::post('ajax/discussion/upvote/{encodedId}', 'UpvoteController@toggleUpvoteDiscussion')
                ->name('ajax.discussion.upvote');

            Route::get('new', 'DiscussionController@create')->name('discussion.create');
            Route::post('new', 'DiscussionController@store')->name('discussion.store');

            Route::view('me/settings', 'front.profile.settings.show')->name('profile.settings.show');
            Route::post('me/settings', 'ProfileSettingsController@update')->name('profile.settings.update');

            Route::post('{category}/{slug}/reply', 'ReplyController@store')->name('reply.store');
        });

        Route::get('search', 'SearchController@search')->name('search');

        Route::get('sitemap.xml', 'SitemapsController@index');
        Route::get('sitemap-categories.xml', 'SitemapsController@categories')->name('sitemap.categories');
        Route::get('sitemap-discussions.xml', 'SitemapsController@discussions')->name('sitemap.discussions');
        Route::get('sitemap-stories.xml', 'SitemapsController@stories')->name('sitemap.stories');
        Route::get('sitemap-users.xml', 'SitemapsController@users')->name('sitemap.users');

        Route::get('p/{slug}', 'PageController@show')->name('page.show');

        Route::get('stories', 'StoryController@index')->name('stories.index');
        Route::get('stories/{slug}', 'StoryController@show')->name('stories.show');

        Route::get('@{username}', 'ProfileController@show')->name('profile.show');

        Route::get('{category}', 'CategoryController@show')
            ->where('category', '[a-z]+')
            ->name('category.show');
        Route::get('{category}/{slug}', 'DiscussionController@show')->name('discussion.show');
    });
});
