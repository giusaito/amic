<?php
/*
 * Projeto: amic
 * Arquivo: web.php
 * ---------------------------------------------------------------------
 * Autor: Leonardo Nascimento
 * E-mail: oi@bewweb.com.br
 * ---------------------------------------------------------------------
 * Data da criação: 19/10/2020 9:02:37 pm
 * Last Modified:  19/11/2020 5:19:11 pm
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
    
    // Início rota notícias
    Route::get('noticias/pesquisar/', 'ArticleController@search')->name('noticia.search');
    Route::resource('/noticia', 'ArticleController');
    Route::post('categoria-noticia/noticias/salvar-ordem/', 'CategoryArticleController@saveOrder')->name('category.noticias.saveOrder');
    route::resource('categoria-noticia', 'CategoryArticleController')->names([
        'index' => 'category.noticias.index',
        'create' => 'category.noticias.create',
        'store' => 'category.noticias.store',
        'update' => 'category.noticias.update',
        'destroy' => 'category.noticias.destroy',
    ]);

    // Final rota notícias


    // Início Tv Amic
    Route::get('tv-amic/pesquisar/', 'TvAmicController@search')->name('tv-amic.search');
    Route::resource('tv-amic', 'TvAmicController');
    // Final Tv Amic

    // Início Podcast
    Route::get('podcast/pesquisar/', 'PodcastController@search')->name('podcast.search');
    Route::resource('podcast', 'PodcastController');
    //Final Podcast
    
    // Início eventos
    Route::get('eventos/pesquisar/', 'EventController@search')->name('evento.search');
    Route::resource('evento', 'EventController');
    //Final eventos
    
    // Início partners
    Route::get('patrocinador/pesquisar/', 'PartnerController@search')->name('patrocinador.search');
    Route::resource('patrocinador', 'PartnerController');
    //Final partners
    
    // Início partners
    Route::get('publicidade/pesquisar/', 'AdsController@search')->name('publicidade.search');
    Route::resource('publicidade', 'AdsController');
    //Final partners
    
    // Início informativo
    Route::get('informativo/pesquisar/', 'InformativeController@search')->name('informativo.search');
    Route::resource('informativo', 'InformativeController');
    //Final informativo
    
    // Início slide
    Route::get('slide/pesquisar/', 'SlideController@search')->name('slide.search');
    Route::resource('slide', 'SlideController');
    //Final slide
    
    // Início phone
    Route::get('telefone/pesquisar/', 'phoneController@search')->name('telefone.search');
    Route::resource('telefone', 'phoneController');
    //Final phone
    
    // Início team
    Route::get('equipe/pesquisar/', 'teamController@search')->name('equipe.search');
    Route::resource('equipe', 'teamController');
    //Final team

    // Início Terra do Sol
    Route::group(['prefix' => 'terra-do-sol', 'namespace' => 'TerraDoSol', 'as' => 'ts.'], function () {
        Route::get('edicoes/pesquisar/', 'EditionsController@search')->name('editions.search');
        route::resource('edicoes', 'EditionsController')->names([
            'index' => 'editions.index',
            'create' => 'editions.create',
            'store' => 'editions.store',
            'edit' => 'editions.edit',
            'update' => 'editions.update',
            'destroy' => 'editions.destroy',
        ]);
        route::resource('sobre', 'AboutController')->names([
            'index' => 'about.index',
            'create' => 'about.create',
            'store' => 'about.store',
            'update' => 'about.update',
            'destroy' => 'about.destroy',
        ]);
        route::resource('checklist', 'ChecklistController')->names([
            'index' => 'checklist.index',
            'create' => 'checklist.create',
            'store' => 'checklist.store',
            'update' => 'checklist.update',
            'destroy' => 'checklist.destroy',
        ]);
        route::resource('dias', 'DaysController')->names([
            'index' => 'days.index',
            'create' => 'days.create',
            'store' => 'days.store',
            'update' => 'days.update',
            'destroy' => 'days.destroy',
        ]);
        route::resource('percurso', 'PathsController')->names([
            'index' => 'paths.index',
            'create' => 'paths.create',
            'store' => 'paths.store',
            'update' => 'paths.update',
            'destroy' => 'paths.destroy',
        ]);
        route::resource('fotos', 'PicturesController')->names([
            'index' => 'pictures.index',
            'create' => 'pictures.create',
            'store' => 'pictures.store',
            'update' => 'pictures.update',
            'destroy' => 'pictures.destroy',
        ]);
        route::resource('recomendacoes', 'RecomendationsController')->names([
            'index' => 'recomendations.index',
            'create' => 'recomendations.create',
            'store' => 'recomendations.store',
            'update' => 'recomendations.update',
            'destroy' => 'recomendations.destroy',
        ]);
        route::resource('slideshow', 'SlideshowController')->names([
            'index' => 'slideshow.index',
            'create' => 'slideshow.create',
            'store' => 'slideshow.store',
            'update' => 'slideshow.update',
            'destroy' => 'slideshow.destroy',
        ]);
        route::resource('patrocinadores', 'SponsorsController')->names([
            'index' => 'sponsors.index',
            'create' => 'sponsors.create',
            'store' => 'sponsors.store',
            'update' => 'sponsors.update',
            'destroy' => 'sponsors.destroy',
        ]);
        route::resource('videos', 'VideosController')->names([
            'index' => 'videos.index',
            'create' => 'videos.create',
            'store' => 'videos.store',
            'update' => 'videos.update',
            'destroy' => 'videos.destroy',
        ]);
    });

    // Final Terra do Sol


});
