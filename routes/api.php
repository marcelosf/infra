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


Route::get('/', 'Home\HomeController@index');

Route::apiResource('/locale', 'Local\LocalController');

Route::apiResource('/switch', 'Devices\SwitchesController');

Route::apiResource('/stack', 'Devices\StacksController');

Route::apiResource('/rack', 'Infra\RacksController');

Route::apiResource('/switch-port', 'Devices\SwitchPortsController');

Route::apiResource('/patch', 'Infra\PatchController');