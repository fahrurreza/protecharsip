<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

//DATA-LIST
Route::post('/get-product', 'API\ApiProductController@index');
Route::post('/create-product', 'API\ApiProductController@store');
Route::post('/show-product', 'API\ApiProductController@show');
Route::post('/update-product', 'API\ApiProductController@update');
Route::post('/delete-product', 'API\ApiProductController@delete');

//DATA-CATEGORY
Route::post('/get-category', 'API\ApiCategoryController@index');
Route::post('/create-category', 'API\ApiCategoryController@store');
Route::post('/show-category', 'API\ApiCategoryController@show');
Route::post('/update-category', 'API\ApiCategoryController@update');
Route::post('/delete-category', 'API\ApiCategoryController@delete');

//DATA-RAK
Route::post('/get-rak', 'API\ApiRakController@index');
Route::post('/create-rak', 'API\ApiRakController@store');
Route::post('/show-rak', 'API\ApiRakController@show');
Route::post('/update-rak', 'API\ApiRakController@update');
Route::post('/delete-rak', 'API\ApiRakController@delete');

//DATA-BOOK
Route::post('/get-book', 'API\ApiBookController@index');
Route::post('/create-book', 'API\ApiBookController@store');
Route::post('/show-book', 'API\ApiBookController@show');
Route::post('/update-book', 'API\ApiBookController@update');
Route::post('/delete-book', 'API\ApiBookController@delete');

//DATA-MENU
Route::post('/get-menu', 'API\ApiMenuController@index');
Route::post('/create-menu', 'API\ApiMenuController@store');
Route::post('/show-menu', 'API\ApiMenuController@show');
Route::post('/update-menu', 'API\ApiMenuController@update');
Route::post('/delete-menu', 'API\ApiMenuController@delete');

//DATA-STUDENT
Route::post('/get-student', 'API\ApiStudentController@index');
Route::post('/create-student', 'API\ApiStudentController@store');
Route::post('/show-student', 'API\ApiStudentController@show');
Route::post('/update-student', 'API\ApiStudentController@update');
Route::post('/delete-student', 'API\ApiStudentController@delete');

//DATA-USER
Route::post('/get-user', 'API\ApiUserController@index');
Route::post('/create-user', 'API\ApiUserController@store');
Route::post('/show-user', 'API\ApiUserController@show');
Route::post('/update-user', 'API\ApiUserController@update');
Route::post('/delete-user', 'API\ApiUserController@delete');

//DATA-STOCK
Route::post('/get-stock', 'API\ApiStockController@index');
Route::post('/create-stock', 'API\ApiStockController@store');
Route::post('/show-stock', 'API\ApiStockController@show');
Route::post('/update-stock', 'API\ApiStockController@update');
Route::post('/delete-stock', 'API\ApiStockController@delete');

//PINJAMAN
Route::post('/get-pinjaman', 'API\ApiPinjamanController@index');
Route::post('/update-pinjaman', 'API\ApiPinjamanController@update');
Route::post('/delete-pinjaman', 'API\ApiPinjamanController@delete');
Route::post('/get-kembalian', 'API\ApiPinjamanController@kembalian');

//DATA-ROLE
Route::post('/get-role', 'API\ApiRoleController@index');
Route::post('/create-role', 'API\ApiRoleController@store');
Route::post('/show-role', 'API\ApiRoleController@show');
Route::post('/update-role', 'API\ApiRoleController@update');
Route::post('/delete-role', 'API\ApiRoleController@delete');
Route::post('/create-access', 'API\ApiRoleController@access');

