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
    Route::get('projetos/lista/{busca?}', 'ProjectController@show')->name('projetos.lista');
    Route::post('projetos/status/{id}', 'ProjectController@status')->name('projetos.status');
    Route::resource('projetos', 'ProjectController');

    // Início rota projetos edições
    Route::get('projetos/edicoes/lista/{busca?}', 'ProjectEditionController@show')->name('projetos.edicoes.lista');
    Route::post('projetos/edicoes/status/{id}', 'ProjectEditionController@status')->name('projetos.edicoes.status');
    Route::resource('projetos/edicoes', 'ProjectEditionController');
    Route::get('projetos/edicoes/create/{id}', 'ProjectEditionController@create')->name('projetos.edicoes.create');

    // Início rota link útil
    Route::group(['prefix' => 'links-uteis', 'as' => 'link.util.'], function () {
        Route::resource('/', 'LinkController');
    });

    Route::get('tv-amic/show/{search?}', 'TvAmicController@search')->name('search');
        Route::resource('tv-amic', 'TvAmicController');
        Route::post('/tv-amic/process-video', 'TvAmicController@process_video');
});
