<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', 'HomeController@index')->name('home');
Route::post('/posts/search', 'HomeController@search')->name('posts.search');
Route::get('/posts/category/{category}', 'HomeController@filter_by_category')->name('home.filter_category');
Route::get('/posts/tag/{tag}', 'HomeController@filter_by_tag')->name('home.filter_tag');

Auth::routes();

Route::get('/posts', 'PostsController@index')->name('posts.index');
Route::get('/posts/create', 'PostsController@create')->name('posts.create');
Route::get('/posts/view/{id}', 'PostsController@view')->name('posts.view');
Route::post('/posts/store', 'PostsController@store')->name('posts.store');
Route::get('/posts/edit/{id}', 'PostsController@edit')->name('posts.edit');
Route::put('/posts/update/{id}', 'PostsController@update')->name('posts.update');
Route::delete('/posts/delete/{id}', 'PostsController@delete')->name('posts.delete');



Route::resource('categories', 'CategoryController');
Route::resource('tags', 'TagController');

Route::get('/users', 'UserController@index')->name('users.index');
Route::get('/users/{user}', 'UserController@view')->name('users.view');
Route::get('/users/{user}/makeAdmin', 'UserController@makeAdmin')->name('users.makeAdmin');
Route::put('/users/{user}/update', 'UserController@update')->name('users.update');