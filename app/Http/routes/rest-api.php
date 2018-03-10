<?php

// 'middleware' => 'web'
Route::group(['prefix' => 'rest-api/v1'], function () {
  // Articles
  Route::get('articles',              'RestApi\ArticleController@index');
  Route::get('articles/{article}',    'RestApi\ArticleController@details');
  Route::post('articles',             'RestApi\ArticleController@add');
  Route::put('articles/{article}',    'RestApi\ArticleController@update');
  Route::delete('articles/{article}', 'RestApi\ArticleController@delete');
  // Token
  Route::delete('token/request',      'RestApi\TokeneController@request');
  Route::delete('token/refresh',      'RestApi\TokeneController@refresh');
  Route::delete('token/delete',      'RestApi\TokeneController@delete');
});


Route::group(['prefix' => 'rest-api/v1/videos', 'middleware' => 'rest_token'], function () {
  //Videos
  Route::get('/',                'RestApi\VideosController@index');
  Route::get('/{id}',           'RestApi\VideosController@details');
  Route::post('/',               'RestApi\VideosController@add');
  Route::put('/{video}',        'RestApi\VideosController@update');
  Route::delete('/{video}',     'RestApi\VideosController@delete');
});

// Users
Route::post('register',             'Auth\RegisterController@register');
