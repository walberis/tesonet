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

//Route::get('/my-issues', function () {
//    return view('home');
//});
Route::get('/my-issues', 'HomeController@showListIssues')->name('myIssues')->middleware('auth');

Route::get('/logout', 'Auth\RegisterController@Logout')->name('logout');
Route::get('/verify-login', 'Auth\RegisterController@Register')->name('verifyLogin');

Route::get('/', 'HomeController@showHome')->name('home')->middleware('guest');
Route::get('/my-issues', 'HomeController@showListIssues')->name('myIssues')->middleware('auth');




