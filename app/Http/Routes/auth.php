<?php


//Login
Route::get('login', 'Auth\AuthUserController@getLogin')->name('login.get');
Route::post('login', 'Auth\AuthUserController@postLogin')->name('login.post');

//Logout
Route::get('logout', 'Auth\AuthUserController@logout')->name('logout');

//Registeration
Route::get('register', 'Auth\AuthUserController@getRegister')->name('register.get');
Route::post('register', 'Auth\AuthUserController@postRegister')->name('register.post');


//User verification
Route::get('verification/{token}', 'Auth\AuthUserController@getVerification')->name('verification.token');
Route::get('verification_resend', 'Auth\AuthUserController@editVerificationResend')->name('verification.resend.edit');
Route::post('verification_resend', 'Auth\AuthUserController@updateVerificationResend')->name('verification.resend.update');

//Password reset
Route::get('password/email', 'Auth\PasswordController@getEmail')->name('password.get.email');
Route::post('password/email', 'Auth\PasswordController@postEmail')->name('password.post.email');
Route::get('password/reset/{token}', 'Auth\PasswordController@getReset')->name('password.get.reset');
Route::post('password/reset', 'Auth\PasswordController@postReset')->name('password.post.reset');

