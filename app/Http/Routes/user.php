<?php

Route::group(['middleware' => 'auth'], function () {



//Profil pages
    Route::group(['prefix' => 'profile'], function () {
        Route::get('/', 'Frontend\ProfileController@index')->name('user.profile');
        Route::get('/edit', 'Frontend\ProfileController@edit')->name('user.profile.edit');
        Route::post('/update', 'Frontend\ProfileController@update')->name('user.profile.update');
        Route::get('/password/edit', 'Frontend\ProfileController@editPassword')->name('user.profile.edit.password');
        Route::post('/password/update', 'Frontend\ProfileController@updatePassword')->name('user.profile.update.password');
    });


//Items pages
    Route::group(['prefix' => 'items'], function () {
        Route::get('/', 'Frontend\ItemsController@index')->name('user.items');
        Route::get('/create', 'Frontend\ItemsController@create')->name('user.items.create');
        Route::post('/store', 'Frontend\ItemsController@store')->name('user.items.store');
        Route::get('/destroy/{id}', 'Frontend\ItemsController@destroy')->name('user.items.destroy');
        Route::get('/edit/{id}', 'Frontend\ItemsController@edit')->name('user.items.edit');
        Route::post('/update/{id}', 'Frontend\ItemsController@update')->name('user.items.update');
    });




});