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
Route::group(['prefix' => 'painel', 'namespace' => 'Backend', 'as' => 'backend.', 'middleware' => ['auth:api']], function () {
    Route::get('projetos', 'ProjectController@get');
    Route::group(['prefix' => 'projeto'], function () {
        Route::post('adicionar', 'ProjectController@add');
        Route::get('editar/{id}', 'ProjectController@edit');
        Route::post('atualizar/{id}', 'ProjectController@update');
        Route::delete('excluir/{id}', 'ProjectController@delete');
    });
});
// Route::middleware('auth:api')->get('/user', function (Request $request) {
//     Route::group(['namespace' => 'Backend'], function()
//     {
        
//         Route::group(['prefix' => 'projeto'], function () {
//             Route::post('adicionar', 'ProjectController@add');
//             Route::get('editar/{id}', 'ProjectController@edit');
//             Route::post('atualizar/{id}', 'ProjectController@update');
//             Route::delete('excluir/{id}', 'ProjectController@delete');
//         });
//     });
//     return $request->user();
// });
