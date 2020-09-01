<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::group(['prefix' => 'painel', 'namespace' => 'Backend', 'as' => 'backend.', 'middleware' => ['web', 'auth', 'activity']], function () {
    // Painel
    Route::resource('/', 'DashboardController');

    // Início rota projetos
    Route::group(['prefix' => 'projetos', 'as' => 'projects.'], function () {
        Route::get('lista/{busca?}', 'ProjectController@get')->name('lista');
        Route::resource('/', 'ProjectController');
    });

    // Início rota link útil
    Route::group(['prefix' => 'links-uteis', 'as' => 'link.util.'], function () {
        Route::resource('/', 'LinkController');
    });

});