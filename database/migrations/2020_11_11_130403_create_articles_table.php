<?php
/*
 * Projeto: amic
 * Arquivo: 2020_11_11_130403_create_articles_table.php
 * ---------------------------------------------------------------------
 * Autor: Leonardo Nascimento
 * E-mail: leonardo.nascimento21@gmail.com
 * ---------------------------------------------------------------------
 * Data da criação: 11/11/2020 10:04:03 am
 * Last Modified:  23/11/2020 9:27:37 am
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

class CreateArticlesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('category_articles', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('slug');
            $table->string('description')->nullable();
            $table->string('image')->nullable();
            $table->nestedSet();
            $table->timestamps();
        });
        
        Schema::create('articles', function (Blueprint $table) {
            $table->id();
            $table->string('title', 191);
            $table->string('slug');
            $table->text('description');
            $table->text('video')->nullable();
            $table->longText('content');
            $table->string('font')->nullable()->comment = "Se a fonte for de outro portal e/ou empresa";
            $table->enum('status', ['PUBLISHED', 'DRAFT'])->default('PUBLISHED')->nullable();
            $table->string('path')->nullable();
            $table->string('image')->nullable();
            $table->string('author_photo')->nullable();
            $table->bigInteger('author_id')->nullable()->unsigned()->comment = "Autor da notícia";
            $table->bigInteger('author_edit_id')->nullable()->unsigned()->comment = "Editado por";
            $table->string('alternative_link')->nullable()->comment = "Leva para outro site";
            $table->bigInteger('template_id')->default(1)->unsigned()->comment = "Qual o layout ele irá assumir";
            $table->bigInteger('feature')->default(0)->unsigned()->comment = "Se é uma notícia fixada 0 => não, 1 => sim";
            $table->timestamp('published_at');
            $table->timestamps();

            $table->foreign('author_id')
            ->references('id')
            ->on('users');
            
            $table->foreign('author_edit_id')
            ->references('id')
            ->on('users');

            $table->foreign('template_id')
            ->references('id')
            ->on('themes');


        });

        Schema::create('category_article', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('category_id')->unsigned();
            $table->bigInteger('article_id')->unsigned();

            $table->foreign('category_id')
                    ->references('id')
                    ->on('category_articles')
                    ->onDelete('cascade');
           
           $table->foreign('article_id')
                    ->references('id')
                    ->on('articles')
                    ->onDelete('cascade');
        });

        DB::statement('ALTER TABLE articles ADD FULLTEXT fulltext_index (title, description)');

        Schema::create('tags', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('slug');
            $table->timestamps();
        });

        Schema::create('tag_article', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('tag_id')->unsigned();
            $table->bigInteger('article_id')->unsigned();

            $table->foreign('tag_id')
                    ->references('id')
                    ->on('tags')
                    ->onDelete('cascade');
           
           $table->foreign('article_id')
                    ->references('id')
                    ->on('articles')
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
        Schema::dropIfExists('category_article');
        Schema::dropIfExists('tag_article');
        Schema::dropIfExists('articles');
        Schema::dropIfExists('category_articles');
        Schema::dropIfExists('tags');
    }
}
