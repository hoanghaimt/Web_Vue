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

Route::get('modproducts', ['as' => 'api-getallmod', 'uses' => 'Api\ApiModProduct@GetAllMod']);
Route::post('modproducts', ['as' => 'api-postnewmod', 'uses' => 'Api\ApiModProduct@AddNewMod']);
Route::get('modproducts/{id}', ['as' => 'api-getmodbyid', 'uses' => 'Api\ApiModProduct@getmodbyid']);
Route::post('modproducts/{id}', ['as' => 'api-postmodbyid', 'uses' => 'Api\ApiModProduct@UpdateMod']);
Route::post('modproducts/remove/{id}', ['as' => 'api-remove', 'uses' => 'Api\ApiModProduct@DeleteMod']);
