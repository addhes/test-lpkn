<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Pertandingan;

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

Route::apiResource('/v1/pertandingan','PertandinganController');
Route::get('/v1/pertandingan/by/{match_id}','PertandinganController@index');

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
