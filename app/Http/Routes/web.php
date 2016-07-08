<?php

Route::group(['middleware' => 'web'], function () {
    //Root page - Homepage
    Route::get('/', 'Frontend\HomepageController@index')->name('web.homepage');


    //Item page
    Route::get('item/{id}', 'Frontend\ItemsController@show')->name('web.item');

    //Category page
    Route::get('category/{id}', 'Frontend\CategoryController@show')->name('web.category');

    //Search
    Route::get('search', 'Frontend\ItemsController@search')->name('web.search');

    //Sitemap
    Route::get('sitemap', 'Frontend\SitemapController@index')->name('web.sitemap');

    //Feed - RSS
    Route::get('feed', 'Frontend\FeedController@index')->name('web.feed');


});