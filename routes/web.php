<?php
/*
 * Projeto: amic
 * Arquivo: web.php
 * ---------------------------------------------------------------------
 * Autor: Leonardo Nascimento
 * E-mail: oi@bewweb.com.br
 * ---------------------------------------------------------------------
 * Data da criação: 19/10/2020 9:02:37 pm
 * Last Modified:  04/12/2020 11:38:11 am
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


// Auth::routes();

// Route::get('/home', 'HomeController@index')->name('home');

Route::group(['middleware' => ['web']], function(){

    Route::group(['prefix' => 'painel', 'namespace' => 'Backend', 'as' => 'backend.', 'middleware' => ['auth', 'activity']], function () {
        // Painel
        // Route::resource('/', 'DashboardController');

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
            'index' => 'category.site.util.index',
            'create' => 'category.site.util.create',
            'store' => 'category.site.util.store',
            'update' => 'category.site.util.update',
            'destroy' => 'category.site.util.destroy',
        ]);
        Route::get('categoria-site-util/{id}/bw-editar',   ['as' => 'category.site.util.edit',  'uses' => 'CategorySiteUtilController@index']);

        // Final Link útil
        
        // Início rota notícias
        Route::get('noticias/pesquisar/', 'ArticleController@search')->name('noticia.search');
        Route::get('noticias/tag/', 'ArticleController@tag')->name('noticia.tag');
        Route::post('noticias/push/{id}', 'ArticleController@push')->name('noticia.push');
        Route::resource('/noticia', 'ArticleController');
        // Route::post('categoria-noticia/noticias/salvar-ordem/', 'CategoryArticleController@saveOrder')->name('category.noticias.saveOrder');
        route::resource('categoria-noticia', 'CategoryArticleController')->names([
            'index' => 'category.noticias.index',
            'create' => 'category.noticias.create',
            'store' => 'category.noticias.store',
            'update' => 'category.noticias.update',
            'destroy' => 'category.noticias.destroy',
        ]);
        Route::get('/{id}/bw-editar', 	['as' => 'category.noticias.edit', 	'uses' => 'CategoryArticleController@index']);
        
        Route::get('foto-noticia/{photo}', ['as' => 'photo.noticias.index', 'uses' => 'PhotoArticleController@index']);
        Route::post('foto-noticia/adicionar/{photo}', ['as' => 'photo.noticias.store', 'uses' =>'PhotoArticleController@store']);
        Route::post('foto-noticia/excluir', ['as' => 'photo.noticias.destroy', 'uses' => 'PhotoArticleController@destroy']);

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
        
        // Início publicidade
        Route::get('publicidade/pesquisar/', 'AdsController@search')->name('publicidade.search');
        Route::resource('publicidade', 'AdsController');
        //Final publicidade
        
        // Início informativo
        Route::get('informativo/pesquisar/', 'InformativeController@search')->name('informativo.search');
        Route::resource('informativo', 'InformativeController');
        //Final informativo
        
        // Início informativo
        Route::get('servico/pesquisar/', 'ServiceController@search')->name('servico.search');
        Route::resource('servico', 'ServiceController');
        //Final informativo
        
        // Início leis e regimentos
        Route::get('lei-regimento/pesquisar/', 'LawController@search')->name('lei.search');
        Route::resource('lei-e-regimento', 'LawController')->names([
            'index'   =>  'lei.index',
            'create'  =>  'lei.create',
            'edit'    =>  'lei.edit',
            'store'   =>  'lei.store',
            'update'  =>  'lei.update',
            'destroy' =>  'lei.destroy',
        ]);;
        //Final leis e regimentos
        
        // Início slide
        Route::get('slide/pesquisar/', 'SlideController@search')->name('slide.search');
        Route::resource('slide', 'SlideController');
        //Final slide
        
        // Início phone
        Route::get('telefone/pesquisar/', 'phoneController@search')->name('telefone.search');
        Route::resource('telefone', 'phoneController');
        //Final phone
        
        // Início equipe
        Route::get('equipe/pesquisar/', 'teamController@search')->name('equipe.search');
        Route::resource('equipe', 'teamController');
        //Final equipe
        
        // Início settings
        Route::resource('configuracoes', 'SettingController');
        //Final settings

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
            Route::group(['prefix'=>'sobre'],function(){
    			Route::get('/{edicao}', ['as' => 'about.index', 'uses' => 'AboutController@index']);
    			Route::post('/{edicao}', ['as' => 'about.store', 'uses' =>'AboutController@store']);
    		});	
            Route::group(['prefix'=>'checklist'],function(){
                Route::get('pesquisar/{edicao}', 'ChecklistController@search')->name('checklist.search');
    			Route::get('/{edicao}', ['as' => 'checklist.index', 'uses' => 'ChecklistController@index']);
    			Route::get('adicionar/{edicao}', ['as' => 'checklist.create', 'uses' =>'ChecklistController@create']);
    			Route::post('adicionar/{edicao}', ['as' => 'checklist.store', 'uses' =>'ChecklistController@store']);
    			Route::get('editar/{edicao}/{id}', ['as' => 'checklist.edit', 'uses' => 'ChecklistController@edit']);
                Route::put('editar/{edicao}/{id}', ['as' => 'checklist.update', 'uses' => 'ChecklistController@update']);
                Route::delete('excluir/{edicao}/{checklist}', ['as' => 'checklist.destroy', 'uses' => 'ChecklistController@destroy']);
    		});	
            Route::group(['prefix'=>'dias'],function(){
                Route::get('pesquisar/{edicao}', 'DaysController@search')->name('days.search');
    			Route::get('/{edicao}', ['as' => 'days.index', 'uses' => 'DaysController@index']);
    			Route::get('adicionar/{edicao}', ['as' => 'days.create', 'uses' =>'DaysController@create']);
    			Route::post('adicionar/{edicao}', ['as' => 'days.store', 'uses' =>'DaysController@store']);
    			Route::get('editar/{edicao}/{id}', ['as' => 'days.edit', 'uses' => 'DaysController@edit']);
                Route::put('editar/{edicao}/{id}', ['as' => 'days.update', 'uses' => 'DaysController@update']);
                Route::delete('excluir/{edicao}/{day}', ['as' => 'days.destroy', 'uses' => 'DaysController@destroy']);
    		});	
            Route::group(['prefix'=>'percurso'],function(){
    			Route::get('/{edicao}', ['as' => 'paths.index', 'uses' => 'PathsController@index']);
    			Route::get('adicionar/{edicao}', ['as' => 'paths.create', 'uses' =>'PathsController@create']);
    			Route::post('adicionar/{edicao}', ['as' => 'paths.store', 'uses' =>'PathsController@store']);
    			Route::get('editar/{edicao}/{id}', ['as' => 'paths.edit', 'uses' => 'PathsController@edit']);
                Route::post('editar/{edicao}/{id}', ['as' => 'paths.update', 'uses' => 'PathsController@update']);
                Route::delete('excluir/{edicao}/{id}', ['as' => 'paths.destroy', 'uses' => 'PathsController@destroy']);
    		});	
            Route::group(['prefix'=>'fotos'],function(){
                Route::get('/{edicao}', ['as' => 'pictures.index', 'uses' => 'PicturesController@index']);
                Route::post('adicionar/{edicao}', ['as' => 'pictures.store', 'uses' =>'PicturesController@store']);
                Route::post('excluir', ['as' => 'pictures.destroy', 'uses' => 'PicturesController@destroy']);
    		});	
            Route::group(['prefix'=>'recomendacoes'],function(){
                Route::get('/{edicao}', ['as' => 'recomendations.index', 'uses' => 'RecomendationsController@index']);
    			Route::post('/{edicao}', ['as' => 'recomendations.store', 'uses' =>'RecomendationsController@store']);
    		});	
            Route::group(['prefix'=>'slideshow'],function(){
                Route::get('/{edicao}', ['as' => 'slideshow.index', 'uses' => 'SlideshowController@index']);
                Route::post('adicionar/{edicao}', ['as' => 'slideshow.store', 'uses' =>'SlideshowController@store']);
                Route::post('excluir', ['as' => 'slideshow.destroy', 'uses' => 'SlideshowController@destroy']);
    		});	
            Route::group(['prefix'=>'patrocinadores'],function(){
                Route::get('pesquisar/{edicao}', 'SponsorsController@search')->name('sponsors.search');
    			Route::get('/{edicao}', ['as' => 'sponsors.index', 'uses' => 'SponsorsController@index']);
    			Route::get('adicionar/{edicao}', ['as' => 'sponsors.create', 'uses' =>'SponsorsController@create']);
    			Route::post('adicionar/{edicao}', ['as' => 'sponsors.store', 'uses' =>'SponsorsController@store']);
    			Route::get('editar/{edicao}/{id}', ['as' => 'sponsors.edit', 'uses' => 'SponsorsController@edit']);
                Route::post('editar/{edicao}/{id}', ['as' => 'sponsors.update', 'uses' => 'SponsorsController@update']);
                Route::delete('excluir/{edicao}/{sponsor}', ['as' => 'sponsors.destroy', 'uses' => 'SponsorsController@destroy']);
    		});	
            Route::group(['prefix'=>'videos'],function(){
    			Route::get('/{edicao}', ['as' => 'videos.index', 'uses' => 'VideosController@index']);
    			Route::get('adicionar/{edicao}', ['as' => 'videos.create', 'uses' =>'VideosController@create']);
    			Route::post('adicionar/{edicao}', ['as' => 'videos.store', 'uses' =>'VideosController@store']);
    			Route::get('editar/{edicao}/{id}', ['as' => 'videos.edit', 'uses' => 'VideosController@edit']);
                Route::post('editar/{edicao}/{id}', ['as' => 'videos.update', 'uses' => 'VideosController@update']);
                Route::delete('excluir/{edicao}/{video}', ['as' => 'videos.destroy', 'uses' => 'VideosController@destroy']);
    		});	
        });
        // Final Terra do Sol

        // Início CNA
        Route::group(['prefix' => 'cna', 'namespace' => 'CNA', 'as' => 'cna.'], function () {
            // CNA
            Route::get('pesquisar/', 'CnaController@search')->name('search');
            route::resource('/', 'CnaController')->names([
                'index' => 'index',
                'create' => 'create',
                'store' => 'store',
                'edit' => 'edit',
                'update' => 'update',
                'destroy' => 'destroy',
            ]);

            // SOBRE
            Route::group(['prefix'=>'sobre'],function(){
    			Route::get('/', ['as' => 'about.index', 'uses' => 'CnaController@about']);
    			Route::post('/', ['as' => 'about.store', 'uses' =>'CnaController@aboutstore']);
            });	
            
            // NOTÍCIAS
            Route::get('noticias/pesquisar/', 'ArticleController@search')->name('noticias.search');
            Route::get('noticias/tag/', 'ArticleController@tag')->name('noticias.tag');
            Route::post('noticias/push/{id}', 'ArticleController@push')->name('noticias.push');
            Route::resource('/noticias', 'ArticleController')->names([
                'index' => 'noticias.index',
                'create' => 'noticias.create',
                'store' => 'noticias.store',
                'edit' => 'noticias.edit',
                'update' => 'noticias.update',
                'destroy' => 'noticias.destroy',
            ]);
            route::resource('categoria-noticia', 'CategoryArticleController')->names([
                'index' => 'category.noticias.index',
                'create' => 'category.noticias.create',
                'store' => 'category.noticias.store',
                'update' => 'category.noticias.update',
                'destroy' => 'category.noticias.destroy',
            ]);
            Route::get('/{id}/bw-editar', 	['as' => 'category.noticias.edit', 	'uses' => 'CategoryArticleController@index']);
            
            Route::get('foto-noticia/{photo}', ['as' => 'photo.noticias.index', 'uses' => 'PhotoArticleController@index']);
            Route::post('foto-noticia/adicionar/{photo}', ['as' => 'photo.noticias.store', 'uses' =>'PhotoArticleController@store']);
            Route::post('foto-noticia/excluir', ['as' => 'photo.noticias.destroy', 'uses' => 'PhotoArticleController@destroy']);

            // DIRETORIA
            Route::group(['prefix'=>'diretoria'],function(){
                Route::get('pesquisar', 'DirectorsController@search')->name('diretoria.search');
    			Route::get('/', ['as' => 'diretoria.index', 'uses' => 'DirectorsController@index']);
    			Route::get('adicionar', ['as' => 'diretoria.create', 'uses' =>'DirectorsController@create']);
    			Route::post('adicionar', ['as' => 'diretoria.store', 'uses' =>'DirectorsController@store']);
    			Route::get('editar/{id}', ['as' => 'diretoria.edit', 'uses' => 'DirectorsController@edit']);
                Route::post('editar/{id}', ['as' => 'diretoria.update', 'uses' => 'DirectorsController@update']);
                Route::delete('excluir/{diretor}', ['as' => 'diretoria.destroy', 'uses' => 'DirectorsController@destroy']);
            });
            
            // EVENTOS
            Route::group(['prefix'=>'eventos'],function(){
                Route::get('pesquisar', 'EventsController@search')->name('eventos.search');
    			Route::get('/', ['as' => 'eventos.index', 'uses' => 'EventsController@index']);
    			Route::get('adicionar', ['as' => 'eventos.create', 'uses' =>'EventsController@create']);
    			Route::post('adicionar', ['as' => 'eventos.store', 'uses' =>'EventsController@store']);
    			Route::get('editar/{id}', ['as' => 'eventos.edit', 'uses' => 'EventsController@edit']);
                Route::post('editar/{id}', ['as' => 'eventos.update', 'uses' => 'EventsController@update']);
                Route::delete('excluir/{evento}', ['as' => 'eventos.destroy', 'uses' => 'EventsController@destroy']);
    		});	
        });
        // Final CNA
    });

    Route::group(['as' => 'frontend.', 'namespace' => 'Frontend'], function()
    {
        Route::get('/', ['as' => 'home.index', 'uses' => 'HomeController@index']);

        Route::get('/ultimas-noticias', ['as' => 'article.index', 'uses' => 'ArticleController@index']);
        Route::get('/noticia/{id}/{slug}', ['as' => 'article.view', 'uses' => 'ArticleController@view']);

        Route::get('/servicos', ['as' => 'service.index', 'uses' => 'ServiceController@index']);
        Route::get('/servico/{slug}', ['as' => 'service.view', 'uses' => 'ServiceController@view']);
    });
});
Auth::routes(['register' => false]);
