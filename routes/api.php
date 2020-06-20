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

// Route::middleware('auth:api')->get('/user', function (Request $request) {
//     return $request->user();
// });
//Route::get('book/{book}/chat','ChatController@index');
Route::middleware('auth')->group( function () {
 Route::get('book/{book}/chat','ChatController@index');
 Route::post('book/{book}/chat','ChatController@store');
});
