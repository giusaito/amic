<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProjectsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('projects', function (Blueprint $table) {
            $table->id();
            $table->string('name',100);
            $table->string('logo',100)->nullable();
            $table->bigInteger('author_id')->unsigned()->nullable();
            $table->enum('status', ['TRUE', 'FALSE'])->default('TRUE');
            $table->timestamps();

            $table->foreign('author_id')
            ->references('id')
            ->on('users');
        });
        Schema::create('project_editions', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('project_id')->unsigned();
            $table->string('logo',100)->nullable();
            $table->text('description');
            $table->string('starring_photo',100)->nullable();
            $table->dateTime('date_event', 0);
            $table->dateTime('date_event_finish', 0);
            $table->bigInteger('author_id')->unsigned()->nullable();
            $table->timestamps();

            $table->foreign('author_id')
            ->references('id')
            ->on('users');

            $table->foreign('project_id')
            ->references('id')
            ->on('projects')
            ->onDelete('cascade');
        });
        Schema::create('project_slideshows', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('projet_edition_id')->unsigned();
            $table->string('file',255);
            $table->string('url',100)->nullable();
            $table->enum('target', ['SELF', 'BLANK'])->default('SELF')->nullable();
            $table->bigInteger('author_id')->unsigned()->nullable();
            $table->timestamps();

            $table->foreign('author_id')
            ->references('id')
            ->on('users');

            $table->foreign('projet_edition_id')
            ->references('id')
            ->on('project_editions')
            ->onDelete('cascade');
        });

        Schema::create('project_photos', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('projet_edition_id')->unsigned();
            $table->string('file',255);
            $table->bigInteger('author_id')->unsigned()->nullable();
            $table->timestamps();

            $table->foreign('author_id')
            ->references('id')
            ->on('users');

            $table->foreign('projet_edition_id')
            ->references('id')
            ->on('project_editions')
            ->onDelete('cascade');
        });

        Schema::create('project_companies', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('projet_edition_id')->unsigned();
            $table->string('name',100);
            $table->string('file',255);
            $table->string('url',100)->nullable();
            $table->bigInteger('author_id')->unsigned()->nullable();
            $table->timestamps();

            $table->foreign('author_id')
            ->references('id')
            ->on('users');

            $table->foreign('projet_edition_id')
            ->references('id')
            ->on('project_editions')
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
        Schema::dropIfExists('projects');
        Schema::dropIfExists('project_editions');
        Schema::dropIfExists('project_slideshows');
        Schema::dropIfExists('project_photos');
        Schema::dropIfExists('project_companies');
    }
}
