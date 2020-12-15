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

Route::get('/', function () {
    return view('top');
})->name('top');



Auth::routes();

Route::get('/user', 'UserController@mypage')->name('user.mypage');//マイページ表示
Route::get('/user/logincheck', 'UserController@logincheck')->name('user.logincheck');


Route::get('/tasks', 'TaskController@index')->name('tasks.index');
Route::post('/tasks/create', 'TaskController@create')->name('tasks.create');
Route::post('/tasks/change/{id}', 'TaskController@change')->name('tasks.change');




Route::get('/home', 'HomeController@index')->name('home');



