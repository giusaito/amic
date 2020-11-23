<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTerraDoSol extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ts_editions', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('subtitle');
            $table->string('path')->nullable();
            $table->string('logo',100);
            $table->string('slug');
            $table->timestamp('subscription_start')->nullable();
            $table->timestamp('subscription_finish')->nullable();
            $table->timestamp('event_start')->nullable();
            $table->timestamp('event_finish')->nullable();
            $table->enum('event_suspended', ['true', 'false'])->default('false');
            $table->string('event_suspended_cause')->nullable();
            $table->timestamps();
        });
        Schema::create('ts_slideshows', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('ts_edition_id')->unsigned();
            $table->string('image',100)->nullable();
            $table->timestamps();

            $table->foreign('ts_edition_id')
            ->references('id')
            ->on('ts_editions')
            ->onDelete('cascade');
        });
        Schema::create('ts_abouts', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('ts_edition_id')->unsigned();
            $table->string('title');
            $table->longText('content');
            $table->string('path1')->nullable();
            $table->string('image1',100)->nullable();
            $table->string('path2')->nullable();
            $table->string('image2',100)->nullable();
            $table->timestamps();

            $table->foreign('ts_edition_id')
            ->references('id')
            ->on('ts_editions')
            ->onDelete('cascade');
        });
        Schema::create('ts_paths', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('ts_edition_id')->unsigned();
            $table->string('video');
            $table->string('map');
            $table->timestamps();

            $table->foreign('ts_edition_id')
            ->references('id')
            ->on('ts_editions')
            ->onDelete('cascade');
        });
        Schema::create('ts_days', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('ts_edition_id')->unsigned();
            $table->string('title');
            $table->text('content');
            $table->text('ambient_conditions');
            $table->timestamps();

            $table->foreign('ts_edition_id')
            ->references('id')
            ->on('ts_editions')
            ->onDelete('cascade');
        });
        Schema::create('ts_videos', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('ts_edition_id')->unsigned();
            $table->string('thumbnail',100);
            $table->string('video');
            $table->timestamps();

            $table->foreign('ts_edition_id')
            ->references('id')
            ->on('ts_editions')
            ->onDelete('cascade');
        });
        Schema::create('ts_pictures', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('ts_edition_id')->unsigned();
            $table->string('image');
            $table->timestamps();

            $table->foreign('ts_edition_id')
            ->references('id')
            ->on('ts_editions')
            ->onDelete('cascade');
        });
        Schema::create('ts_checklists', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('ts_edition_id')->unsigned();
            $table->longText('content');
            $table->timestamps();

            $table->foreign('ts_edition_id')
            ->references('id')
            ->on('ts_editions')
            ->onDelete('cascade');
        });
        Schema::create('ts_recomendations', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('ts_edition_id')->unsigned();
            $table->longText('content');
            $table->timestamps();

            $table->foreign('ts_edition_id')
            ->references('id')
            ->on('ts_editions')
            ->onDelete('cascade');
        });
        Schema::create('ts_sponsors', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('ts_edition_id')->unsigned();
            $table->string('logo',100);
            $table->string('title');
            $table->string('slug');
            $table->string('url')->nullable();
            $table->timestamps();

            $table->foreign('ts_edition_id')
            ->references('id')
            ->on('ts_editions')
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
        Schema::dropIfExists('ts_videos');
        Schema::dropIfExists('ts_slideshows');
        Schema::dropIfExists('ts_abouts');
        Schema::dropIfExists('ts_paths');
        Schema::dropIfExists('ts_days');
        Schema::dropIfExists('ts_pictures');
        Schema::dropIfExists('ts_checklists');
        Schema::dropIfExists('ts_recomendations');
        Schema::dropIfExists('ts_sponsors');
        Schema::dropIfExists('ts_editions');        
    }
}