<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLinksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('category_links', function (Blueprint $table) {
            $table->id();
            $table->string('name', 191);
            $table->string('slug', 191);
            $table->string('description', 191);
            $table->string('image', 191)->nullable();
            $table->timestamps();
        });

        
        Schema::create('links', function (Blueprint $table) {
            $table->id();
            $table->string('name', 191);
            $table->string('slug', 191);
            $table->string('description', 191);
            $table->string('image', 191)->nullable();
            $table->string('url', 191);
            $table->timestamps();
        });

        DB::statement('ALTER TABLE links ADD FULLTEXT fulltext_index (name, description, url)');

        Schema::create('category_link', function (Blueprint $table) {
            $table->BigIncrements('id');
            $table->bigInteger('category_id')->unsigned();
            $table->bigInteger('link_id')->unsigned();

            $table->foreign('category_id')
                    ->references('id')
                    ->on('category_links')
                    ->onDelete('cascade');
           
           $table->foreign('link_id')
                    ->references('id')
                    ->on('links')
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
        Schema::dropIfExists('category_link');
        Schema::dropIfExists('links');
        Schema::dropIfExists('category_links');
      
    }
}
