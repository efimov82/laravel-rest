<?php

Route::get('articles',              'RestApi\ArticleController@index');
Route::get('articles/{article}',    'RestApi\ArticleController@details');
Route::post('articles',             'RestApi\ArticleController@save');
Route::put('articles/{article}',    'RestApi\ArticleController@update');
Route::delete('articles/{article}', 'RestApi\ArticleController@delete');
Route::post('register',             'Auth\RegisterController@register');
