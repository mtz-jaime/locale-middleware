<?php

Route::prefix('middleware')->group(function () {
    Route::get('test', 'MtzJaime\LocaleMiddleware\LocaleCookieController@index')->name('middleware.test');
    Route::get('visit/{locale}', 'MtzJaime\LocaleMiddleware\LocaleCookieController@cookieRedirect')->name('middleware.cookieRedirect');
});