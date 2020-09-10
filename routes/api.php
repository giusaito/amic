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

Route::group(['prefix' => 'auth'], function () {
    Route::post('login', 'AuthController@login');
    Route::post('signup', 'AuthController@signup');
    Route::get('signup/activate/{token}', 'AuthController@signupActivate');

    Route::group([
      'middleware' => 'auth:api'
    ], function() {
        Route::get('logout', 'AuthController@logout');
        Route::get('user', 'AuthController@user');
        // Route::group(['prefix' => 'painel', 'namespace' => 'Backend', 'as' => 'backend.'],function(){
        //     Route::get('projetos', 'ProjectController@get');
        //     Route::group(['prefix' => 'projeto'], function () {
        //         Route::post('adicionar', 'ProjectController@add');
        //         Route::get('editar/{id}', 'ProjectController@edit');
        //         Route::post('atualizar/{id}', 'ProjectController@update');
        //         Route::delete('excluir/{id}', 'ProjectController@delete');
        //     });
        // });
    });
});
Route::group(['namespace' => 'Auth', 'middleware' => 'api', 'prefix' => 'password'], function () {    
    Route::post('create', 'PasswordResetController@create');
    Route::get('find/{token}', 'PasswordResetController@find');
    Route::post('reset', 'PasswordResetController@reset');
});

// Route::resource('categories', 'CategoryController');
Route::group(['prefix' => 'painel', 'namespace' => 'Backend', 'as' => 'backend.'], function () {
    Route::post('/projetos/status/{id}', 'ProjectController@status')->name('status');
    Route::resource('projetos', 'ProjectController');

    // Tv Amic
    Route::resource('tv-amic', 'TvAmicController');
});