<?php

use App\Controllers;

Route::get('/', 'ProjectController@getIndex');
Route::post('/', 'ProjectController@postNew');

Route::get('/signup', 'ProjectController@getSignUp');
Route::post('/signup', 'ProjectController@postSignUp');

Route::get('/login', 'ProjectController@getLogIn');
Route::post('/login', 'ProjectController@postLogIn');

Route::get('/newpost', 'ProjectController@getNew');

Route::get('/logout', 'ProjectController@logout');



?>