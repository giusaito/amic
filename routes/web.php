<?php
/*
 * Projeto: amic
 * Arquivo: web.php
 * ---------------------------------------------------------------------
 * Autor: Leonardo Nascimento
 * E-mail: oi@bewweb.com.br
 * ---------------------------------------------------------------------
 * Data da criação: 19/10/2020 9:02:37 pm
 * Last Modified:  11/11/2020 10:27:33 am
 * Modificado por: Leonardo Nascimento - <oi@bewweb.com.br>
 * ---------------------------------------------------------------------
 * Copyright (c) 2020 Bewweb
 * HISTORY:
 * Date      	By	Comments
 * ----------	---	---------------------------------------------------------
 */

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
        Route::get('site-util/pesquisar/', 'SiteUtilController@search')->name('site-util.search');
        Route::resource('/site-util', 'SiteUtilController');
        route::resource('categoria-site-util', 'CategorySiteUtilController')->names([
            'index' => 'category.site.index',
            'create' => 'category.site.create',
            'update' => 'category.site.update',
            'destroy' => 'category.site.destroy',
        ]);

    // Final Link útil
    
    // Início rota link útil
        Route::get('noticias/pesquisar/', 'ArticleController@search')->name('noticia.search');
        Route::resource('/noticia', 'ArticleController');
        route::resource('categoria-noticia', 'CategoryArticleController')->names([
            'index' => 'category.site.index',
            'create' => 'category.site.create',
            'update' => 'category.site.update',
            'destroy' => 'category.site.destroy',
        ]);

    // Final Link útil


    // Início Tv Amic
    Route::get('tv-amic/pesquisar/', 'TvAmicController@search')->name('tv-amic.search');
    Route::resource('tv-amic', 'TvAmicController');
    // Final Tv Amic

    // Início Podcast
    Route::get('podcast/pesquisar/', 'PodcastController@search')->name('podcast.search');
    Route::resource('podcast', 'PodcastController');
    //Final Podcast


});
