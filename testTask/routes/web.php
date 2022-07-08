<?php

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


Route::get('/updateClient/{id}', 'App\Http\Controllers\MainController@updateClientPage')->name('updateClientPage');

Route::get('/addUserPage', 'App\Http\Controllers\MainController@addUserPage')->name('addUserPage');

Route::get('/addCarPage', 'App\Http\Controllers\MainController@addCarPage')->name('addCarPage');

Route::post('/addCar','App\Http\Controllers\MainController@addCar')->name('addCar');

Route::post('/addClient','App\Http\Controllers\MainController@addClient')->name('Client');

Route::post('/updateClient','App\Http\Controllers\MainController@updateClient')->name('updateClient');

Route::post('/updateCar','App\Http\Controllers\MainController@updateCar')->name('updateCar');

Route::get('/deleteCar/{id}','App\Http\Controllers\MainController@deleteCar')->name('deleteCar');


Route::get('/allCars/{page}','App\Http\Controllers\MainController@allCars')->name('allCars');


Route::get('/{page}','App\Http\Controllers\MainController@main')->name('main');