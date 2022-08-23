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
Route::get('/getUsers', 'App\Http\Controllers\MainController@getUsers')->name('getUsers');

Route::get('/addUserPage', 'App\Http\Controllers\MainController@addUserPage')->name('addUserPage');
//Метод формы выше
Route::post('/addClient','App\Http\Controllers\MainController@addClient')->name('Client');
//Форма добавления Машины
Route::get('/addCarPage', 'App\Http\Controllers\CarController@addCarPage')->name('addCarPage');
//Метод формы выше
Route::post('/addCar','App\Http\Controllers\CarController@addCar')->name('addCar');
//Страница обновления данных клиента
Route::get('/updateClient/{id}', 'App\Http\Controllers\MainController@updateClientPage')->name('updateClientPage');
// Обновление данных
Route::post('/updateClient','App\Http\Controllers\MainController@updateClient')->name('updateClient');
Route::post('/updateCar','App\Http\Controllers\CarController@updateCar')->name('updateCar');
Route::post('/changeParking','App\Http\Controllers\CarController@changeParking')->name('changeParking');

//Удаление данных
Route::get('/deleteCar/{id}','App\Http\Controllers\CarController@deleteCar')->name('deleteCar');
Route::get('/deleteUser/{id}','App\Http\Controllers\MainController@deleteUser')->name('deleteUser');

//Страница вывода стоянки. Вторая штука для AJAX метода.
Route::get('/allCars/{page}','App\Http\Controllers\CarController@allCars')->name('allCars');
Route::post('allCars/fetch','App\Http\Controllers\CarController@fetch')-> name('carController.fetch');


// Внизу потому что /{page} оверрайдит все остальные /* теги.
Route::get('/{page}','App\Http\Controllers\MainController@main')->name('main');
// База
Route::get('', function(){
 return redirect("/1");
});
