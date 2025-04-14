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

    //DATA
    Route::get('/data-menu', 'MenuController@index')->name('menu');
    Route::get('/role-menu', 'RoleController@role_menu')->name('role-menu');
    Route::post('/setting-menu', 'RoleController@setting_menu')->name('setting-menu');
    Route::post('/store-menu', 'RoleController@store_menu')->name('store-menu');
    Route::get('/data-siswa', 'StudentController@index')->name('student');
    Route::get('/data-instruktur', 'InstrukturController@index')->name('instruktur');
    Route::get('/data-role', 'RoleController@index')->name('role');
    Route::get('/data-user', 'UserController@index')->name('user');

    //LETTER
    Route::get('/surat-masuk', 'LetterController@surat_masuk')->name('surat-masuk');
    Route::get('/surat-masuk/{slack}', 'LetterController@surat_masuk_detail')->name('lihat-surat-masuk');
    Route::get('/edit-surat-masuk/{slack}', 'LetterController@edit_surat_masuk')->name('edit-surat-masuk');
    Route::get('/document/{slack}', 'LetterController@document')->name('document-surat');
    Route::get('/delete-document-surat/{slack}', 'LetterController@delete_document_surat')->name('delete-document-surat');
    Route::get('/delete-surat/{slack}', 'LetterController@delete_surat')->name('delete-surat');
    Route::post('/create-surat-masuk', 'LetterController@create_surat_masuk')->name('create-surat-masuk');
    Route::post('/update-surat', 'LetterController@update_surat')->name('update-surat');
    Route::get('/laporan-surat-masuk', 'LetterController@laporan_surat_masuk')->name('laporan-surat-masuk');
    

    Route::get('/surat-keluar', 'LetterController@surat_keluar')->name('surat-keluar');
    Route::get('/surat-keluar/{slack}', 'LetterController@surat_keluar_detail')->name('lihat-surat-keluar');
    Route::get('/edit-surat-keluar/{slack}', 'LetterController@edit_surat_keluar')->name('edit-surat-keluar');
    Route::post('/create-surat-keluar', 'LetterController@create_surat_keluar')->name('create-surat-keluar');
    Route::get('/laporan-surat-keluar', 'LetterController@laporan_surat_keluar')->name('laporan-surat-keluar');
    Route::get('/print-laporan', 'LetterController@print_laporan')->name('print-laporan');

    //LOGOUT
    Route::get('/change-password', 'LoginController@change_password')->name('change-password');
    Route::post('/change-password', 'LoginController@update_password')->name('change_password');

    //LOGOUT
    Route::post('/logout', 'LoginController@logout')->name('logout');
});

