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
    return view('welcome');
});

Route::get('tshirts', 'DataController@index')->name('home');

Route::get('/generate/image', 'CreateImageController@index');

Route::post('/result', 'DisplayImageController@index')->name('display');

Route::get('/result/{tshirt}/{logo}', 'CreateImageController@index')->name('result');

Route::post('/save/{tshirt}/{logo}', 'CreateImageController@store')->name('save');

//Route::post('/import/{logo}', 'CreateImageController@create')->name('import');