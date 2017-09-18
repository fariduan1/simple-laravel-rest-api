<?php

use Illuminate\Http\Request;

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

// Opens view to register form
Route::post('register', ['uses' => 'UserController@getRegister']);
Route::post('login', ['uses' => 'UserController@getLogin']);
Route::get('logout', ['uses' => 'UserController@getLogout ']);
Route::group(['prefix' => 'places', 'as' => 'places.'], function () {
  Route::post('create', ['as' => 'create', 'uses' => 'PlaceController@create']);
  Route::post('update', ['as' => 'update', 'uses' => 'PlaceController@update']);
  Route::get('fetch/{id}', ['as' => 'fetch', 'uses' => 'PlaceController@fetch']);
  Route::get('delete/{id}', ['as' => 'delete', 'uses' => 'PlaceController@delete']);

});
