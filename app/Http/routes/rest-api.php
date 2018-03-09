<?php

// Articles
Route::get('articles',              'RestApi\ArticleController@index');
Route::get('articles/{article}',    'RestApi\ArticleController@details');
Route::post('articles',             'RestApi\ArticleController@add');
Route::put('articles/{article}',    'RestApi\ArticleController@update');
Route::delete('articles/{article}', 'RestApi\ArticleController@delete');

// Users
Route::post('register',             'Auth\RegisterController@register');
