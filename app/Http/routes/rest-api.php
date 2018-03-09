<?php

// Articles
Route::get('articles',              'RestApi\ArticleController@index');
Route::get('articles/{article}',    'RestApi\ArticleController@details');
Route::post('articles',             'RestApi\ArticleController@add');
Route::put('articles/{article}',    'RestApi\ArticleController@update');
Route::delete('articles/{article}', 'RestApi\ArticleController@delete');

//Videos
Route::get('videos',                'RestApi\VideosController@index');
Route::get('videos/{video}',        'RestApi\VideosController@details');
Route::post('videos',               'RestApi\VideosController@add');
Route::put('videos',                'RestApi\VideosController@update');
Route::delete('videos',             'RestApi\VideosController@delete');

// Users
Route::post('register',             'Auth\RegisterController@register');
