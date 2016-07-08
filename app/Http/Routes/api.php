<?php

Route::group(['prefix' => 'api'], function () {

    //API V1
    Route::group(['prefix' => 'v1'], function () {


        Route::group(['middleware' => 'api'], function () {


            /**
             * @title Homepage
             * @description Get all categories
             * @group Homepage
             * @param
             * @return id, name, image
             */
            Route::get('homepage', 'Api\HomeController@getCategories')->name('api.home');


            /**
             * @title Category
             * @description Get all Items by Category id
             * @group Category
             * @param  id
             * @return name, image, content, time
             */
            Route::get('category/{id}', 'Api\CategoriesController@getItems')->name('api.category');


            /**
             * @title Categories
             * @description Get all categories
             * @group Category
             * @param  null
             * @return id, name
             */
            Route::get('categories', 'Api\CategoriesController@getCategories')->name('api.categories');


            /**
             * @title Item
             * @description Get Item by id
             * @group Item
             * @param  id
             * @return name,image, content, ingredients, time, created_at, name, category
             */
            Route::get('item/{id}', 'Api\ItemsController@getItem')->name('api.item');


            /**
             * @title Search
             * @description Get Search Items
             * @group Item
             * @param  query
             * @return name, image, content, time
             */
            Route::get('search/{query}', 'Api\ItemsController@getSearch')->name('api.search');


            /**
             * @title Register
             * @description Post register new user
             * @group Register
             * @param name , email, password
             * @return null
             */
            Route::post('register', 'Auth\AuthApiController@postRegister')->name('api.register');


            /**
             * @title Forgot password
             * @description Get user email and reset password
             * @group Forgot password
             * @param email
             * @return null
             */
            Route::post('forgot_password', 'Auth\AuthApiController@postForgotPassword')->name('api.forgot.password');

            /**
             * @title Login
             * @description Post login User
             * @group Auth
             * @param email , password
             * @return user_id, token
             */
            Route::post('login', 'Auth\AuthApiController@postlogin')->name('api.login');


            //Auth for API
            Route::group(['middleware' => 'jwt.auth'], function () {

                Route::group(['prefix' => 'profile'], function () {

                    /**
                     * @title Profile
                     * @description Get Profile Data
                     * @group Profile
                     * @param token
                     * @return id, name, email, created_at
                     */
                    Route::get('', 'Api\ProfileController@getProfile')->name('api.user.profile');


                    /**
                     * @title Edit Profile
                     * @description Post edit profile
                     * @group Profile
                     * @param token , name, email
                     * @return null
                     */
                    Route::post('edit', 'Api\ProfileController@postProfile')->name('api.user.edit.profile');

                    /**
                     * @title Edit Password
                     * @description Post new password
                     * @group Profile
                     * @param token , password
                     * @return null
                     */
                    Route::post('password/edit', 'Api\ProfileController@postPassword')->name('api.user.edit.password');


                });


                Route::group(['prefix' => 'items'], function () {

                    /**
                     * @title Items
                     * @description Get all user's items
                     * @group Profile
                     * @param token
                     * @return id, image, name, created_at
                     */
                    Route::get('', 'Api\ProfileController@getProfileItems')->name('api.user.items');

                    /**
                     * @title Update Item
                     * @description Update item By ID
                     * @group Profile
                     * @param token , id
                     * @return null
                     */
                    Route::post('update', 'Api\ProfileController@postUpdateItem')->name('api.user.items.update');

                    /**
                     * @title Store Item
                     * @description Store Item
                     * @group Profile
                     * @param token
                     * @return null
                     */
                    Route::post('store', 'Api\ProfileController@postStoreItem')->name('api.user.items.store');

                    /**
                     * @title Store Item
                     * @description Store Item
                     * @group Profile
                     * @param token
                     * @return null
                     */
                    Route::post('store', 'Api\ProfileController@postStoreItem')->name('api.user.items.store');

                    /**
                     * @title Destroy Item
                     * @description Delete item
                     * @group Profile
                     * @param token, id
                     * @return null
                     */
                    Route::get('destroy/{id}', 'Api\ProfileController@destroyItem')->name('api.user.items.destroy');
                });


            });

        });
    });
});