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

Route::get('/', 'App\Http\Controllers\DashboardController@index')->name('index');

Route::get('/qrcode', [QrCodeController::class, 'qrcode.print']);
Route::post('/qrprint', 'App\Http\Controllers\QrCodeController@print')->name('qrcode.print');
Route::get('/qrcode/history', 'App\Http\Controllers\QrCodeController@qrhistory')->name('qrcode.history');

Route::get('/tenant','App\Http\Controllers\RSController@index')->name('tenant.index');
Route::post('/tenant/create','App\Http\Controllers\RSController@store')->name('tenant.create');
Route::post('/tenant/edit','App\Http\Controllers\RSController@edit')->name('tenant.edit');
Route::post('/tenant/update','App\Http\Controllers\RSController@update')->name('tenant.update');
Route::post('/tenant/delete','App\Http\Controllers\RSController@delete')->name('tenant.delete');

Route::get('/inventory','App\Http\Controllers\InvController@index')->name('inventory.index');
Route::post('/inventory','App\Http\Controllers\InvController@store')->name('inv.create');

Route::get('/stock','App\Http\Controllers\StockController@index')->name('stock.index');
Route::post('/stock/keluar','App\Http\Controllers\StockController@keluar')->name('stock.keluar');
Route::get('/stock/inputIndex','App\Http\Controllers\StockController@inputIndex')->name('stock.inputIndex');
Route::post('/stock/input/','App\Http\Controllers\StockController@input')->name('stock.input');
Route::get('/stock/history/','App\Http\Controllers\StockController@history')->name('stock.history');