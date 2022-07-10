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
//Если ты не будешь подписывать руты потом запутаешься!!!!!!


//Добавление клиента
Route::get('/addUserPage', 'App\Http\Controllers\MainController@addUserPage')->name('addUserPage');
//Метод формы выше
Route::post('/addClient','App\Http\Controllers\MainController@addClient')->name('Client');
//Форма добавления Машины
Route::get('/addCarPage', 'App\Http\Controllers\MainController@addCarPage')->name('addCarPage');
//Метод формы выше
Route::post('/addCar','App\Http\Controllers\MainController@addCar')->name('addCar');
//Страница обновления данных клиента
Route::get('/updateClient/{id}', 'App\Http\Controllers\MainController@updateClientPage')->name('updateClientPage');
// Обновление данных
Route::post('/updateClient','App\Http\Controllers\MainController@updateClient')->name('updateClient');
Route::post('/updateCar','App\Http\Controllers\MainController@updateCar')->name('updateCar');
Route::post('/changeParking','App\Http\Controllers\MainController@changeParking')->name('changeParking');

//Удаление данных
Route::get('/deleteCar/{id}','App\Http\Controllers\MainController@deleteCar')->name('deleteCar');
Route::get('/deleteUser/{id}','App\Http\Controllers\MainController@deleteUser')->name('deleteUser');

//Страница вывода стоянки. Вторая штука для AJAX метода.
Route::get('/allCars/{page}','App\Http\Controllers\MainController@allCars')->name('allCars');
Route::post('allCars/fetch','App\Http\Controllers\MainController@fetch')-> name('mainController.fetch');


// Внизу потому что /{page} оверрайдит все остальные /* теги.
Route::get('/{page}','App\Http\Controllers\MainController@main')->name('main');
// База
Route::get('', function(){
 return redirect("/1");
});