<?php

use Illuminate\Http\Request;
use App\Http\Requests\StoreMember;

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

Route::namespace('Api')->group(function () {
    Route::post('/members', 'MembersController@store');
    Route::post('/members/{id}', 'MembersController@update');
    Route::get('/members', 'MembersController@index');
    Route::get('/members/{id}', 'MembersController@getById');

    Route::get('/countries', 'CountriesController@index');
});
