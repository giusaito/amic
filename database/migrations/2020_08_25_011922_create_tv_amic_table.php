<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTvAmicTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tv_amics', function (Blueprint $table) {
            $table->id();
            $table->string('name', 90);
            $table->string('slug', 191);
            $table->string('url_video', 191);
            $table->string('description', 191);
            $table->string('image', 191)->nullable();
            $table->text('iframe');
            $table->string('width', 10)->nullable();
            $table->string('height', 10)->nullable();
            $table->string('provider_name', 191)->nullable();
            $table->string('provider_url', 191)->nullable();
            $table->string('license', 191)->nullable();
            $table->enum('status', ['PUBLISHED', 'DRAFT'])->default('PUBLISHED')->nullable();
            $table->bigInteger('author_id')->unsigned()->nullable();
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
        Schema::dropIfExists('tv_amics');
    }
}
