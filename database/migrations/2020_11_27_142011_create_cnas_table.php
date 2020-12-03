<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCnasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cnas', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->text('description')->nullable();
            $table->string('imagem_destaque_path')->nullable();
            $table->string('imagem_destaque')->nullable();
            $table->string('about_foto_path')->nullable();
            $table->string('about_foto')->nullable();
            $table->text('about_content')->nullable();
            $table->string('logo_path')->nullable();
            $table->string('logo')->nullable();
            $table->timestamps();
        });
        Schema::create('cna_events', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('cna_id')->unsigned();
            $table->string('title');
            $table->string('description')->nullable();
            $table->string('slug');
            $table->timestamp('event_start')->nullable();
            $table->timestamp('event_finish')->nullable();
            $table->enum('event_suspended', ['true', 'false'])->default('false');
            $table->string('event_suspended_cause')->nullable();
            $table->timestamps();

            $table->foreign('cna_id')
            ->references('id')
            ->on('cnas')
            ->onDelete('cascade');
        });
        Schema::create('cna_directors', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('cna_id')->unsigned();
            $table->string('name');
            $table->string('cargo')->nullable();
            $table->string('slug');
            $table->string('foto_path')->nullable();
            $table->string('foto')->nullable();
            $table->timestamps();

            $table->foreign('cna_id')
            ->references('id')
            ->on('cnas')
            ->onDelete('cascade');
        });
        Schema::create('cna_category_articles', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('cna_id')->unsigned();
            $table->string('title');
            $table->string('slug');
            $table->string('description')->nullable();
            $table->string('image')->nullable();
            $table->nestedSet();
            $table->timestamps();
            
            $table->foreign('cna_id')
            ->references('id')
            ->on('cnas')
            ->onDelete('cascade');
        });
        
        Schema::create('cna_articles', function (Blueprint $table) {
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

        Schema::create('cna_category_article', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('cna_category_id')->unsigned();
            $table->bigInteger('cna_article_id')->unsigned();

            $table->foreign('cna_category_id')
                    ->references('id')
                    ->on('cna_category_articles')
                    ->onDelete('cascade');
           
           $table->foreign('cna_article_id')
                    ->references('id')
                    ->on('cna_articles')
                    ->onDelete('cascade');
        });

        DB::statement('ALTER TABLE cna_articles ADD FULLTEXT fulltext_index (title, description)');

        Schema::create('cna_tags', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('slug');
            $table->timestamps();
        });

        Schema::create('cna_tag_article', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('cna_tag_id')->unsigned();
            $table->bigInteger('cna_article_id')->unsigned();

            $table->foreign('cna_tag_id')
                    ->references('id')
                    ->on('cna_tags')
                    ->onDelete('cascade');
           
           $table->foreign('cna_article_id')
                    ->references('id')
                    ->on('cna_articles')
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
        DB::statement('SET FOREIGN_KEY_CHECKS = 0');
        Schema::dropIfExists('cnas');
        Schema::dropIfExists('cna_events');
        Schema::dropIfExists('cna_directors');
        Schema::dropIfExists('cna_category_articles');
        Schema::dropIfExists('cna_articles');
        Schema::dropIfExists('cna_tags');
        Schema::dropIfExists('cna_tag_article');
        DB::statement('SET FOREIGN_KEY_CHECKS = 1');
    }
}
