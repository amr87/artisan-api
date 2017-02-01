<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateGeoLocationTables extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {

        Schema::create('countries', function(Blueprint $table) {
            $table->increments('id');
            $table->string('name', 256);
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::create('states', function(Blueprint $table) {
            $table->increments('id');
            $table->string('name', 256);
            $table->integer('country_id')->unsigned()->index();
            $table->foreign('country_id')
                    ->references('id')
                    ->on('countries')
                    ->onDelete('cascade');
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::create('districts', function(Blueprint $table) {
            $table->increments('id');
            $table->string('name', 256);
            $table->integer('state_id')->unsigned()->index();
            $table->foreign('state_id')
                    ->references('id')
                    ->on('states')
                    ->onDelete('cascade');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        //

        Schema::drop('countries');
        Schema::drop('states');
        Schema::drop('districts');
    }

}
