<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateServicesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('services', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('slug');
            $table->string('description');
            $table->string('path');
            $table->string('image');
            $table->string('path_internal')->nullable();
            $table->string('image_internal')->nullable();
            $table->longText('content');
            $table->string('benefit_icon_1')->nullable()->comment('icon desc 1');
            $table->string('benefit_desc_1')->nullable();
            $table->string('benefit_icon_2')->nullable()->comment('icon desc 2');
            $table->string('benefit_desc_2')->nullable();
            $table->string('benefit_icon_3')->nullable()->comment('icon desc 3');
            $table->string('benefit_desc_3')->nullable();
            $table->string('benefit_icon_4')->nullable()->comment('icon desc 4');
            $table->string('benefit_desc_4')->nullable();;
            $table->longText('after_content')->nullable();;
            $table->longText('desc_form_contact');
            $table->longText('email_to');
            
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('services');
    }
}
