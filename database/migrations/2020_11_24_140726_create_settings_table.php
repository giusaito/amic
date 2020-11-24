<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSettingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('settings', function (Blueprint $table) {
            $table->id();
            $table->string('name')->nullable();
            $table->string('logomarca')->nullable();
            $table->string('logomarca_footer')->nullable();
            $table->string('email')->nullable();
            $table->string('address')->nullable();
            $table->integer('address_number')->nullable();
            $table->char('zipcode', 10)->nullable();
            $table->string('city')->nullable();
            $table->char('state', 20)->nullable();
            $table->char('phone', 15)->nullable();
            $table->char('phone2', 15)->nullable();
            $table->char('whatsapp', 15)->nullable();
            $table->char('whatsapp2', 15)->nullable();
            $table->string('facebook')->nullable();
            $table->string('instagram')->nullable();
            $table->string('twitter')->nullable();
            $table->string('linkedin')->nullable();
            $table->string('youtube')->nullable();
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
        Schema::dropIfExists('settings');
    }
}
