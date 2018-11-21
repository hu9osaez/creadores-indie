<?php

Route::prefix('radar')->name('radar::')->group(function () {
    Route::get('/', 'HomeController@index')->name('home');

    Route::get('stories', 'StoryController@index')->name('stories.index');
    Route::get('stories/create', 'StoryController@create')->name('stories.create');
    Route::post('stories/create', 'StoryController@store')->name('stories.store');
});
