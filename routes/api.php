<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PelangganController;
use App\Http\Controllers\BarangController;
use App\Http\Controllers\TransaksiController;


/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/getpelanggan',[PelangganController::class,'getpelanggan']);
Route::get('/getid_pelanggan/{id}',[PelangganController::class,'getid_pelanggan']);
Route::post('/createpelanggan',[PelangganController::class,'createpelanggan']);
Route::put('/updatepelanggan/{id}',[PelangganController::class,'updatepelanggan']);
Route::delete('/deletepelanggan/{id}',[PelangganController::class,'deletepelanggan']);

Route::get('/getbarang',[BarangController::class,'getbarang']);
Route::get('/getid/{id}',[BarangController::class,'getid']);
Route::post('/createbarang',[BarangController::class,'createbarang']);
Route::put('/updatebarang/{id}',[BarangController::class,'updatebarang']);
Route::delete('/deletebarang/{id}',[BarangController::class,'deletebarang']);

Route::get('/gettransaksi',[TransaksiController::class,'gettransaksi']);
Route::get('/getid_transaksi/{id}',[TransaksiController::class,'getid_transaksi']);
Route::post('/createtransaksi',[TransaksiController::class,'createtransaksi']);
Route::put('/updatetransaksi/{id}',[TransaksiController::class,'updatetransaksi']);
Route::delete('/deletetransaksi/{id}',[TransaksiController::class,'deletetransaksi']);
