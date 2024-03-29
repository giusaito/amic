<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePodcastsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('podcasts', function (Blueprint $table) {
            $table->id();
            $table->string('title', 90);
            $table->string('slug', 191);
            $table->string('description', 191);
            $table->string('path', 191)->nullable();
            $table->string('image', 191)->nullable();
            $table->text('iframe');
            $table->text('content')->nullable();;
            $table->enum('status', ['PUBLISHED', 'DRAFT'])->default('PUBLISHED')->nullable();
            $table->bigInteger('author_id')->unsigned()->nullable();
            $table->timestamp('published_at');
            $table->timestamps();

            $table->foreign('author_id')
            ->references('id')
            ->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('podcasts');
    }
}
