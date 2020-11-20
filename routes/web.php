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
    Route::name('terra-do-sol.')->group(function () {
        route::resource('edicoes', 'EditionsController')->names([
            'index' => 'ts.editions.index',
            'create' => 'ts.editions.create',
            'store' => 'ts.editions.store',
            'update' => 'ts.editions.update',
            'destroy' => 'ts.editions.destroy',
        ]);
        route::resource('sobre', 'AboutController')->names([
            'index' => 'ts.about.index',
            'create' => 'ts.about.create',
            'store' => 'ts.about.store',
            'update' => 'ts.about.update',
            'destroy' => 'ts.about.destroy',
        ]);
        route::resource('checklist', 'ChecklistController')->names([
            'index' => 'ts.checklist.index',
            'create' => 'ts.checklist.create',
            'store' => 'ts.checklist.store',
            'update' => 'ts.checklist.update',
            'destroy' => 'ts.checklist.destroy',
        ]);
        route::resource('dias', 'DaysController')->names([
            'index' => 'ts.days.index',
            'create' => 'ts.days.create',
            'store' => 'ts.days.store',
            'update' => 'ts.days.update',
            'destroy' => 'ts.days.destroy',
        ]);
        route::resource('percurso', 'PathsController')->names([
            'index' => 'ts.paths.index',
            'create' => 'ts.paths.create',
            'store' => 'ts.paths.store',
            'update' => 'ts.paths.update',
            'destroy' => 'ts.paths.destroy',
        ]);
        route::resource('fotos', 'PicturesController')->names([
            'index' => 'ts.pictures.index',
            'create' => 'ts.pictures.create',
            'store' => 'ts.pictures.store',
            'update' => 'ts.pictures.update',
            'destroy' => 'ts.pictures.destroy',
        ]);
        route::resource('recomendacoes', 'RecomendationsController')->names([
            'index' => 'ts.recomendations.index',
            'create' => 'ts.recomendations.create',
            'store' => 'ts.recomendations.store',
            'update' => 'ts.recomendations.update',
            'destroy' => 'ts.recomendations.destroy',
        ]);
        route::resource('slideshow', 'SlideshowController')->names([
            'index' => 'ts.slideshow.index',
            'create' => 'ts.slideshow.create',
            'store' => 'ts.slideshow.store',
            'update' => 'ts.slideshow.update',
            'destroy' => 'ts.slideshow.destroy',
        ]);
        route::resource('patrocinadores', 'SponsorsController')->names([
            'index' => 'ts.sponsors.index',
            'create' => 'ts.sponsors.create',
            'store' => 'ts.sponsors.store',
            'update' => 'ts.sponsors.update',
            'destroy' => 'ts.sponsors.destroy',
        ]);
        route::resource('videos', 'VideosController')->names([
            'index' => 'ts.videos.index',
            'create' => 'ts.videos.create',
            'store' => 'ts.videos.store',
            'update' => 'ts.videos.update',
            'destroy' => 'ts.videos.destroy',
        ]);
    });

    // Final Terra do Sol


});
