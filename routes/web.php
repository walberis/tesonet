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

//Route::get('/', function () {
//    return view('home');
//});

Route::get('/', 'HomeController@showHome');
Route::get('/logout', 'Auth\LoginController@Logout');
Route::get('/login', 'Auth\LoginController@Login')->name('login');
Route::get('/gh-auth-verify', 'Auth\LoginController@Login')->name('ghAuthVerify');


