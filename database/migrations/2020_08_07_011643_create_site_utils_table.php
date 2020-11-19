<?php
/*
 * Projeto: amic
 * Arquivo: 2020_08_07_011643_create_site_utils_table.php
 * ---------------------------------------------------------------------
 * Autor: Leonardo Nascimento
 * E-mail: leonardo.nascimento21@gmail.com
 * ---------------------------------------------------------------------
 * Data da criação: 11/11/2020 9:29:59 am
 * Last Modified:  19/11/2020 4:05:00 pm
 * Modified By: Leonardo Nascimento - <leonardo.nascimento21@gmail.com> / MAC OS
 * ---------------------------------------------------------------------
 * Copyright (c) 2020 Leo
 * HISTORY:
 * Date      	By	Comments
 * ----------	---	---------------------------------------------------------
 */

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSiteUtilsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('category_site_utils', function (Blueprint $table) {
            $table->id();
            $table->string('title', 191);
            $table->string('slug');
            $table->string('description', 191);
            $table->unsignedBigInteger('_lft');
            $table->unsignedBigInteger('_rgt');
            $table->unsignedBigInteger('parent_id');

            $table->timestamps();
        });

        
        Schema::create('site_utils', function (Blueprint $table) {
            $table->id();
            $table->string('title', 191);
            $table->string('slug');
            $table->string('description', 191);
            $table->string('url', 191);
            $table->enum('status', ['PUBLISHED', 'DRAFT'])->default('PUBLISHED')->nullable();
            $table->bigInteger('author_id')->unsigned()->nullable();
            $table->timestamp('published_at');
            $table->timestamps();

            $table->foreign('author_id')
            ->references('id')
            ->on('users');
        });

        DB::statement('ALTER TABLE site_utils ADD FULLTEXT fulltext_index (title, description, url)');

        Schema::create('category_site_util', function (Blueprint $table) {
            $table->BigIncrements('id');
            $table->bigInteger('category_id')->unsigned();
            $table->bigInteger('link_id')->unsigned();

            $table->foreign('category_id')
                    ->references('id')
                    ->on('category_site_utils')
                    ->onDelete('cascade');
           
           $table->foreign('link_id')
                    ->references('id')
                    ->on('site_utils')
                    ->onDelete('cascade');
        });
        
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('category_site_util');
        Schema::dropIfExists('site_utils');
        Schema::dropIfExists('category_site_utils');
      
    }
}
