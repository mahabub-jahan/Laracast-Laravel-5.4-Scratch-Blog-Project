<?php

//Route for posts
Route::get('/', 'PostsController@index')->name('home');
Route::get('/posts/create', 'PostsController@create');
Route::post('/posts', 'PostsController@store');
Route::get('/posts/{post}', 'PostsController@show');

//Tag
Route::get('/posts/tags/{tag}', 'TagsController@index');

//Route for comments
Route::post('/posts/{post}/comments', 'CommentsController@store');

//Auth
Route::get('/register','RegistrationController@create');
Route::post('/register','RegistrationController@store');

Route::get('/login','SessionsController@create');
Route::post('/login','SessionsController@store');
Route::get('/logout','SessionsController@destroy');





