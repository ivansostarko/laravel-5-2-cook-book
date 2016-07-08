<?php

//Admin pages
Route::group(['middleware' => 'admin'], function () {

    Route::group(['middleware' => 'auth:admin'], function () {


        Route::group(['prefix' => 'admin'], function () {

            Route::get('/dashboard', 'Admin\DashboardController@index')->name('admin.dashboard');
            Route::get('/logout', 'Auth\AuthAdminController@logout')->name('admin.logout');

            //Profiles
            Route::group(['prefix' => 'profile'], function () {
                Route::get('/',  'Admin\ProfileController@index')->name('admin.profile');
                Route::get('/edit', 'Admin\ProfileController@edit')->name('admin.profile.edit');
                Route::post('/update', 'Admin\ProfileController@update')->name('admin.profile.update');
                Route::get('/password/edit', 'Admin\ProfileController@editPassword')->name('admin.profile.password.edit');
                Route::post('/password/update',  'Admin\ProfileController@updatePassword')->name('admin.profile.password.update');

            });



            //Admins
               Route::group(['prefix' => 'admins'], function () {
                Route::get('/', 'Admin\AdminsController@index')->name('admin.admins');
                Route::get('/create', 'Admin\AdminsController@create')->name('admin.admins.create');
                Route::post('/store', 'Admin\AdminsController@store')->name('admin.admins.store');
                Route::get('/destroy/{id}', 'Admin\AdminsController@destroy')->name('admin.admins.destroy');
                Route::get('/edit/{id}', 'Admin\AdminsController@edit')->name('admin.admins.edit');
                Route::post('/update/{id}', 'Admin\AdminsController@update')->name('admin.admins.update');
                Route::get('/password/edit/{id}','Admin\AdminsController@editPassword')->name('admin.admins.password.edit');
                Route::post('/password/update/{id}', 'Admin\AdminsController@updatePassword')->name('admin.admins.password.update');

            });

            //Users
            Route::group(['prefix' => 'users'], function () {
                Route::get('/',  'Admin\UsersController@index')->name('admin.users');
                Route::get('/create', 'Admin\UsersController@create')->name('admin.users.create');
                Route::post('/store', 'Admin\UsersController@store')->name('admin.users.store');
                Route::get('/destroy/{id}', 'Admin\UsersController@destroy')->name('admin.users.destroy');
                Route::get('/show/{id}', 'Admin\UsersController@show')->name('admin.users.show');
                Route::get('/edit/{id}', 'Admin\UsersController@edit')->name('admin.users.edit');
                Route::post('/update/{id}', 'Admin\UsersController@update')->name('admin.users.update');
                Route::get('/password/edit/{id}','Admin\UsersController@editPassword')->name('admin.users.password.edit');
                Route::post('/password/update/{id}', 'Admin\UsersController@updatePassword')->name('admin.users.password.update');
                Route::get('/ban/{id}', 'Admin\UsersController@ban')->name('admin.users.ban');
                Route::get('/unban/{id}', 'Admin\UsersController@unban')->name('admin.users.unban');
                Route::get('/verify/{id}', 'Admin\UsersController@verify')->name('admin.users.verify');
            });

            //Categories
            Route::group(['prefix' => 'categories'], function () {
                Route::get('/', 'Admin\CategoriesController@index')->name('admin.categories');
                Route::get('/create', 'Admin\CategoriesController@create')->name('admin.categories.create');
                Route::post('/store', 'Admin\CategoriesController@store')->name('admin.categories.store');
                Route::get('/destroy/{id}',  'Admin\CategoriesController@destroy')->name('admin.categories.destroy');
                Route::get('/edit/{id}', 'Admin\CategoriesController@edit')->name('admin.categories.edit');
                Route::post('/update/{id}', 'Admin\CategoriesController@update')->name('admin.categories.update');

            });

            //Items
            Route::group(['prefix' => 'items'], function () {
                Route::get('/', 'Admin\ItemsController@index')->name('admin.items');
                Route::get('/destroy/{id}', 'Admin\ItemsController@destroy')->name('admin.items.destroy');
                Route::get('/edit/{id}', 'Admin\ItemsController@edit')->name('admin.items.edit');
                Route::post('/update/{id}','Admin\ItemsController@update')->name('admin.items.update');
            });

            //Activities
            Route::group(['prefix' => 'activities'], function () {
                Route::get('/', 'Admin\ActivitiesController@index')->name('admin.activities');
                Route::get('/clear', 'Admin\ActivitiesController@clear')->name('admin.activities.clear');
            });

            //Settings
            Route::group(['prefix' => 'settings'], function () {
                Route::get('/', 'Admin\SettingsController@index')->name('admin.settings');
                Route::post('/store', 'Admin\SettingsController@store')->name('admin.settings.store');
            });
            

        });



    });
});