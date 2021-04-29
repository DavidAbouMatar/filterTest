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

Route::get('apartment', 'apartmentController@index');
Route::post('/apartment/store', 'apartmentController@store')->name('apartment.store');

Route::get('expenses', 'expensesController@index');
Route::post('/expenses/store', 'expensesController@store')->name('expenses.store');

Route::get('list', 'listController@index');
// Route::post('/list/store', 'expensesController@store')->name('expenses.store');
Route::post('/list/fetch_data', 'listController@fetch_data')->name('daterange.fetch_data');