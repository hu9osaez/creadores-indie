<?php

Route::prefix('radar')->name('radar::')->group(function () {
    Route::get('/', 'HomeController@index')->name('home');
});
