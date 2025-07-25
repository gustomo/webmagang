<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SupplierController;
use App\Http\Controllers\BarangController;
use App\Http\Controllers\TransaksiController;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});



Route::resource('supplier', SupplierController::class);
Route::get('/print_all',[SupplierController::class,'printAll']);
//Route::get('/supplier/printAll', [SupplierController::class, 'printAll'])->name('supplier.printAll');

Route::resource('barang', BarangController::class);
Route::get('/barang-print_all',[BarangController::class,'printAll']);



Route::resource('transaksi', TransaksiController::class);
Route::get('/transaksi/{id}/print', [TransaksiController::class, 'print'])
     ->name('transaksi.print');
