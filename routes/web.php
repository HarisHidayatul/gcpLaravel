<?php

use App\Http\Controllers\api_bee_cloud_controller;
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

Route::get('/', function () {
    return view('welcome');
});
Route::get('/refreshSatuan',[api_bee_cloud_controller::class,'getSatuanBee']);
Route::get('/refreshItem',[api_bee_cloud_controller::class,'getItemBee']);
Route::get('/refreshTransaksi',[api_bee_cloud_controller::class,'getAllTransaction']);
Route::get('/sinkronTransaksi',[api_bee_cloud_controller::class,'sinkronisasiTransaksi']);