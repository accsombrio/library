<?php

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

Route::group(array('middleware'=>'auth'), function(){
    Route::get('/', array('as'=>'home', 'uses'=>'UserController@home'));
});
Route::get('/login',array('as'=>'login','uses'=>'UserController@getLogin'));
Route::post('/login',array('as'=>'login-post','uses'=>'UserController@postLogin'));
Route::get('/register',array('as'=>'register', 'uses'=>'UserController@getRegister'));
Route::post('/register',array('as'=>'register-post', 'uses'=>'UserController@postRegister'));
Route::get('/logout',array('as'=>'logout', 'uses'=>'UserController@logout'));
Route::post('/borrow/{book_id}/{boolean}',array('as'=>'borrow-post', 'uses'=>'UserController@postBorrow'));
Route::get('/addbook',array('as'=>'addbook', 'uses'=>'UserController@getAddBook'));
Route::post('/addbook',array('as'=>'addbook-post', 'uses'=>'UserController@postAddBook'));