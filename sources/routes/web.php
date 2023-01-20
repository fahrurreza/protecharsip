<?php

use Illuminate\Support\Facades\Route;
use App\Http\Livewire\Livewire;

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
Route::middleware('guest')->group(function() {
    Route::get('/login', 'LoginController@index')->name('login');
    Route::post('/login', 'LoginController@store')->name('login');
    
});


Route::middleware('auth')->group(function() {
    Route::get('/', 'DashboardController@index')->name('dashboard');
    Route::get('/dashboard', 'DashboardController@index')->name('dashboard');

    Route::get('/tes', 'DashboardController@tes')->name('tes');

    //DATA
    Route::get('/data-menu', 'MenuController@index')->name('menu');
    Route::get('/role-menu', 'RoleController@role_menu')->name('role-menu');
    Route::post('/setting-menu', 'RoleController@setting_menu')->name('setting-menu');
    Route::post('/store-menu', 'RoleController@store_menu')->name('store-menu');
    Route::get('/data-rak', 'RakController@index')->name('rak');
    Route::get('/data-kategori', 'CategoryController@index')->name('kategori');
    Route::get('/data-buku', 'BookController@index')->name('book');
    Route::get('/data-stock', 'StockController@index')->name('stock');
    Route::get('/data-siswa', 'StudentController@index')->name('student');
    Route::get('/data-role', 'RoleController@index')->name('role');
    Route::get('/data-user', 'UserController@index')->name('user');

    //PINJAMAN
    Route::get('/pinjam-buku', 'PinjamanController@index')->name('pinjaman');
    Route::post('/create-pinjaman', 'PinjamanController@store');
    Route::get('/pengembalian-buku', 'PinjamanController@kembalian')->name('kembalian');

    //LOGOUT
    Route::get('/change-password', 'LoginController@change_password')->name('change-password');
    Route::post('/change-password', 'LoginController@update_password')->name('change_password');

    //LOGOUT
    Route::post('/logout', 'LoginController@logout')->name('logout');
});

