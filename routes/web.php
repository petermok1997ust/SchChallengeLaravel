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

Route::get('/', "GoodController@getGood")->name("home");
Route::get('/delete', "GoodController@deleteGood")->name('delete_good');
Route::get('/update', "GoodController@changeStatus")->name('update_good');

Route::get('/driver/register', function () {
    return view('driver_register');
});
Route::get('/driver', "DriverController@getDriver")->name('driver');
Route::get('/driver/delete', "DriverController@deleteDriver")->name('delete_driver');

Route::get('/php_info', function() {
   return phpinfo();
})
// Route::get('/driver/register', "DriverController@registerDriver");
