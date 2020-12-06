<?php
/*
 * Projeto: amic
 * Arquivo: AppServiceProvider.php
 * ---------------------------------------------------------------------
 * Autor: Leonardo Nascimento
 * E-mail: <oi@bewweb.com.br>
 * ---------------------------------------------------------------------
 * Data da criação: 19/10/2020 11:33:06 pm
 * Data última modificação: 15/10/202020 10:04:18 pm
 * Last Modified:  19/10/2020 11:33:15 pm
 * Modificado por: Leonardo Nascimento - <oi@bewweb.com.br>
 * ---------------------------------------------------------------------
 * Copyright (c) 2020 Bewweb
 * HISTORY:
 * Date      	By	Comments
 * ----------	---	---------------------------------------------------------
 */

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Route;
use Faker\Generator as FakerGenerator;
use Faker\Factory as FakerFactory;

class AppServiceProvider extends ServiceProvider
{ 
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Route::resourceVerbs([
            'create' => 'bw-adicionar',
            'edit' => 'bw-editar'
        ]);

        $this->app->singleton(FakerGenerator::class, function () {
            return FakerFactory::create('pt_BR');
        });
    }
}
