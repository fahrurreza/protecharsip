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

//DATA-STUDENT
Route::post('/get-instruktur', 'API\ApiInstrukturController@index');
Route::post('/create-instruktur', 'API\ApiInstrukturController@store');
Route::post('/show-instruktur', 'API\ApiInstrukturController@show');
Route::post('/update-instruktur', 'API\ApiInstrukturController@update');
Route::post('/delete-instruktur', 'API\ApiInstrukturController@delete');

//DATA-USER
Route::post('/get-user', 'API\ApiUserController@index');
Route::post('/create-user', 'API\ApiUserController@store');
Route::post('/show-user', 'API\ApiUserController@show');
Route::post('/update-user', 'API\ApiUserController@update');
Route::post('/delete-user', 'API\ApiUserController@delete');

//DATA-ROLE
Route::post('/get-role', 'API\ApiRoleController@index');
Route::post('/create-role', 'API\ApiRoleController@store');
Route::post('/show-role', 'API\ApiRoleController@show');
Route::post('/update-role', 'API\ApiRoleController@update');
Route::post('/delete-role', 'API\ApiRoleController@delete');
Route::post('/create-access', 'API\ApiRoleController@access');

