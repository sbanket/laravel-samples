<?php

/** Only authenticated users */
Route::middleware('auth')->group(
    function () {
        Route::get('/profile', 'ProfileController@index')->name('user.profile');
        Route::post('/profile/pwd', 'ProfileController@updatePassword')->name('user.profile.update.password');
    });

/** Login routes */
Route::get('/login', 'Auth\LoginController@showLoginForm')->name('login');
Route::post('/login', 'Auth\LoginController@login')->name('login.submit');
Route::get('/logout', 'Auth\LoginController@logout')->name('logout')->middleware('auth');

/** Password Reset routes */
Route::get('/password/request', 'Auth\ForgotPasswordController@showLinkRequestForm')->name('password.request');
Route::post('/password/request', 'Auth\ForgotPasswordController@sendResetLinkEmail')->name('password.request.submit');
Route::get('/password/reset/{token}', 'Auth\ResetPasswordController@showResetForm')->name('password.reset');
Route::post('/password/reset', 'Auth\ResetPasswordController@reset')->name('password.reset.submit');
